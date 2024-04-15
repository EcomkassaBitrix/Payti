<?php

namespace App\Http\Controllers\Api;

use App\Models\OfdService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OfdServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OfdService::where('user_id', Auth::id())->limit(100)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'login' => 'required',
            'password' => 'required',
            'shop_id' => 'required'
        ]);
        $params = $request->all();
        $params['user_id'] = Auth::id();
        $params['token'] = null;
        return OfdService::create($params);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfdService $ofdService)
    {
        if( $ofdService['user_id'] === Auth::id() ){
            $request->validate([
                'name' => 'required',
                'login' => 'required',
                'password' => 'required',
                'shop_id' => 'required'
            ]);
            $params = $request->all();
            $params['user_id'] = $ofdService['user_id'];
            $params['token'] = null;
            $ofdService->update($params);
            return $ofdService;
        }
        return response()->json([
            'message' => 'Data is not owner for edit'
        ], Response::HTTP_BAD_REQUEST);
    }

}
