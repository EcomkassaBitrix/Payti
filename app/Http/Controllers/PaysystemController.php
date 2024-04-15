<?php

namespace App\Http\Controllers;

use App\Models\Paysystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Response;

class PaysystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $paysystems = Paysystem::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
        return view('paysystem.index', compact(['paysystems']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paysystem.create');
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
        Paysystem::create($params);
        return redirect()->route('paysystem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paysystem  $paysystem
     * @return \Illuminate\Http\Response
     */
    public function show(Paysystem $paysystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paysystem  $paysystem
     * @return \Illuminate\Http\Response
     */
    public function edit(Paysystem $paysystem)
    {
        if( $paysystem['user_id'] === Auth::id() ) {
            return view('paysystem.edit', compact(['paysystem']));
        }
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
        }
        return redirect()->route('paysystem.index');
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
