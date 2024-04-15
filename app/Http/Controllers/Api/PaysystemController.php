<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paysystem;
use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PaysystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Paysystem::where('user_id', Auth::id())->limit(100)->get();
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
            'password' => 'required',
            'login' => 'required'
        ]);
        $params = $request->all();
        $params['token_notification'] = Uuid::uuid4();
        $params['user_id'] = Auth::id();
        return Paysystem::create($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paysystem $paysystem)
    {
        if( $paysystem['user_id'] === Auth::id() ){
            $request->validate([
                'name' => 'required',
                'password' => 'required',
                'login' => 'required'
            ]);
            $params = $request->all();
            $params['user_id'] = $paysystem['user_id'];
            $params['token_notification'] = $paysystem['token_notification'];
            $paysystem->update($params);
            return $paysystem;
        }
        return response()->json([
            'message' => 'Data is not owner for edit'
        ], Response::HTTP_BAD_REQUEST);
    }
}
