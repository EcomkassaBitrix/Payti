<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bunch;
use App\Models\PaysystemOrder;
use App\Models\Sberbank;
use App\Models\OfdService;
use App\Models\Paysystem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;

class SberbankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paysystem  $paysystem
     * @return \Illuminate\Http\Response
     */
    public function show( $paysystem )
    {
        DB::table('logs')->insert([
            ['description' => json_encode( $_REQUEST )]
        ]);

        $paysystem_select = Paysystem::where('token_notification', '=', $paysystem)->first();
        if( $paysystem_select !== null && $_REQUEST['status'] == 1 && ( $_REQUEST['operation'] == 'deposited' || $_REQUEST['operation'] == 'refunded' ) ) {
            //СЮДА ДОБАВИТЬ НОРМ ПРОВЕРКУ НА УНИКАЛЬНОСТЬ!
            if( !PaysystemOrder::where([['order_number', '=', $_REQUEST['orderNumber']], ['paysystem_id', '=', $paysystem_select->id]] )->exists() || $_REQUEST['operation'] == 'refunded' ) {
                $endpoint = "https://3dsec.sberbank.ru/payment/rest/getOrderStatusExtended.do";
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', $endpoint, ['verify' => false, 'query' => [
                    'userName' => $paysystem_select->login,
                    'password' => $paysystem_select->password,
                    'orderId' => $_REQUEST['mdOrder'],
                    'verify' => 'false'
                ]]);

                $contentSber = json_decode($response->getBody());
                if( $contentSber->errorCode == 0 ){
                    $order = PaysystemOrder::create([
                        'paysystem_id' => $paysystem_select->id,
                        'order_number' => $_REQUEST['orderNumber'],
                        'mdOrder' => $_REQUEST['mdOrder'],
                        'ofd_created_unix' => '0',
                        'data' => json_encode( $contentSber ) ,
                        'ofd_try_create' => '0',
                        'operation' => $_REQUEST['operation'],
                        'user_id' => $paysystem_select->user_id,
                    ]);
                    if( $order->id ){
                        //отправляем запрос на печать чека

                        $bunch_select = Bunch::where([['paysystem_id', '=', $paysystem_select->id], ['user_id', '=', $paysystem_select->user_id]]  )->first();
                        if( $paysystem_select !== null ){
                            $ofdService_select = OfdService::where([['id', '=', $bunch_select->ofd_service_id], ['user_id', '=', $paysystem_select->user_id]]  )->first();
                            if( $ofdService_select !== null ){


                                $endpoint = "https://app.ecomkassa.ru/fiscalorder/v2/getToken";
                                $client = new \GuzzleHttp\Client();
                                $response = $client->request('GET', $endpoint, ['verify' => false, 'query' => [
                                    'login' => $ofdService_select->login,
                                    'pass' => $ofdService_select->password
                                ]]);
                                $contentOfdToken = json_decode($response->getBody());


                                if( $contentOfdToken->code == 0 ){
                                    //$contentSber
                                    $clientEmail = $ofdService_select->client_email;//Default email user ofd checks
                                    if( $contentSber->payerData->email ){
                                        $clientEmail = $contentSber->payerData->email;
                                    }
                                    else if( $contentSber->orderBundle->customerDetails->email ){
                                        $clientEmail = $contentSber->orderBundle->customerDetails->email;
                                    }
                                    $arrayItems = array();

                                    $vatValue = $ofdService_select->vat;
                                    if( $ofdService_select->vat != 'none'){
                                        $vatValue = 'vat'.$ofdService_select->vat;
                                    }
                                    $totalPaySum = 0;
                                    foreach ( $contentSber->orderBundle->cartItems->items as $valueOrder ) {
                                       $arrayObj = array(
                                           "name" => $valueOrder->name,
                                           "price" => $valueOrder->itemAmount / 100 / $valueOrder->quantity->value,
                                           "quantity" => $valueOrder->quantity->value,
                                           "sum" =>  (ceil( ($valueOrder->quantity->value * ($valueOrder->itemAmount / 100 / $valueOrder->quantity->value )) * 100 )) / 100,
                                           "measurement_unit" => $valueOrder->quantity->measure,
                                           "payment_method" => $ofdService_select->payment_method,
                                           "payment_object" => $ofdService_select->payment_object,
                                           "vat" => [
                                               "type" => $vatValue
                                           ]
                                       );
                                       array_push($arrayItems, $arrayObj);
                                       $totalPaySum = $totalPaySum + (ceil( ($valueOrder->quantity->value * ($valueOrder->itemAmount / 100 / $valueOrder->quantity->value )) * 100 )) / 100;
                                    }
                                    $objOfd = [
                                        "external_id" => $paysystem_select->name."-".$_REQUEST['orderNumber']."-".time(),
                                        "receipt" => [
                                            "client" => [
                                                "email" => $clientEmail
                                            ],
                                            "company" => [
                                                "email" => $ofdService_select->company_email,
                                                "sno" => $ofdService_select->company_sno,
                                                "inn" => $ofdService_select->company_inn,
                                                "payment_address" => $ofdService_select->company_payment_address
                                            ],
                                            "items" => $arrayItems,
                                            "payments" => [
                                                [
                                                    "type" => 1,
                                                    "sum" => $totalPaySum//$contentSber->paymentAmountInfo->totalAmount / 100
                                                ]
                                            ],
                                            "total" => $totalPaySum//$contentSber->paymentAmountInfo->totalAmount / 100
                                        ],
                                        "timestamp" => date('d.m.y H:i:s')
                                    ];
                                    DB::table('logs')->insert([
                                        ['description' => json_encode( $objOfd )]
                                    ]);
                                    $methodEcom = 'sell';
                                    if( $_REQUEST['operation'] == 'deposited' ){
                                        $methodEcom = 'sell';
                                    }
                                    else if( $_REQUEST['operation'] == 'refunded' ){
                                        $methodEcom = 'sell_refund';
                                    }
                                    $endpoint = "https://app.ecomkassa.ru/fiscalorder/v2/".$ofdService_select->shop_id."/$methodEcom?token=".$contentOfdToken->token;
                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->request('POST', $endpoint, ['verify' => false, 'body' => json_encode( $objOfd )]);
                                    $contentOfd = json_decode($response->getBody());
                                    DB::table('logs')->insert([
                                        ['description' => $endpoint]
                                    ]);
                                    DB::table('logs')->insert([
                                        ['description' => json_encode( $contentOfd )]
                                    ]);
                                    if( $contentOfd->error == null ){
                                        PaysystemOrder::where("id", $order->id)->update(["ofd_try_create" => 1, "ofd_created_unix" => time()]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return response()->json(['status' => 'ok'], 200);
        }
        return response()->json(['error' => 'Error msg'], 404);//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paysystem  $paysystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paysystem $paysystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paysystem  $paysystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paysystem $paysystem)
    {
        //
    }
}
