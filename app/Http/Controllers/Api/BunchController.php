<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bunch;
use App\Models\OfdService;
use App\Models\Paysystem;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bunch::where('user_id', Auth::id())->limit(100)->get();
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
            'paysystem_id' => 'required',
            'ofd_service_id' => 'required'
        ]);
        $params = $request->all();
        $params['user_id'] = Auth::id();
        if( Paysystem::where([['id', '=', $params['paysystem_id']], ['user_id', '=', $params['user_id']]] )->exists()) {
            if( OfdService::where([['id', '=', $params['ofd_service_id']], ['user_id', '=', $params['user_id']]] )->exists()) {
                if(! Bunch::where([['paysystem_id', '=', $params['paysystem_id']], ['ofd_service_id', '=', $params['ofd_service_id']], ['user_id', '=', $params['user_id']]] )->exists()) {
                    return   Bunch::create($params);
                }
                return response()->json([
                    'message' => 'Data is already exists'
                ], Response::HTTP_BAD_REQUEST);
            }
        }
        return response()->json([
            'message' => 'Data is not owner for edit'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bunch $bunch)
    {
        if( $bunch['user_id'] === Auth::id() ){
            $request->validate([
                'paysystem_id' => 'required',
                'ofd_service_id' => 'required'
            ]);
            $params = $request->all();
            $params['user_id'] = $bunch['user_id'];
            if( Paysystem::where([['id', '=', $params['paysystem_id']], ['user_id', '=', $params['user_id']]] )->exists()) {
                if( OfdService::where([['id', '=', $params['ofd_service_id']], ['user_id', '=', $params['user_id']]] )->exists()) {
                    if(! Bunch::where([['paysystem_id', '=', $params['paysystem_id']], ['ofd_service_id', '=', $params['ofd_service_id']], ['user_id', '=', $params['user_id']]] )->exists()) {
                        $bunch->update($params);
                        return $bunch;
                    }
                    return response()->json([
                        'message' => 'Data is already exists'
                    ], Response::HTTP_BAD_REQUEST);
                }
            }
        }
        return response()->json([
            'message' => 'Data is not owner for edit'
        ], Response::HTTP_BAD_REQUEST);
    }
}
