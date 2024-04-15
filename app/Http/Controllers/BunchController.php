<?php

namespace App\Http\Controllers;

use App\Models\Bunch;
use App\Models\OfdService;
use App\Models\Paysystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BunchController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bunches = Bunch::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
        return view('bunch.index', compact(['bunches']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paysystems = Paysystem::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
        $ofdServices = OfdService::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
        return view('bunch.create', compact(['paysystems','ofdServices']));
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
                    Bunch::create($params);
                }
            }
        }
        return redirect()->route('bunch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bunch  $bunch
     * @return \Illuminate\Http\Response
     */
    public function show(Bunch $bunch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bunch  $bunch
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunch $bunch)
    {
        if( $bunch['user_id'] === Auth::id() ){
            $paysystems = Paysystem::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
            $ofdServices = OfdService::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
            return view('bunch.edit', compact(['paysystems', 'ofdServices', 'bunch']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bunch  $bunch
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
                    }
                }
            }
        }
        return redirect()->route('bunch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bunch  $bunch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunch $bunch)
    {
        //
    }
}
