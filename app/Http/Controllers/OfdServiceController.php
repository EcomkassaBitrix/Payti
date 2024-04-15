<?php

namespace App\Http\Controllers;

use App\Models\OfdService;
use App\Models\Paysystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class OfdServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ofdServices = OfdService::orderBy('created_at')->where('user_id', Auth::id())->limit(100)->get();
        return view('ofdService.index', compact(['ofdServices']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ofdService.create');
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
        OfdService::create($params);
        return redirect()->route('ofdService.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfdService  $ofdService
     * @return \Illuminate\Http\Response
     */
    public function show(OfdService $ofdService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfdService  $ofdService
     * @return \Illuminate\Http\Response
     */
    public function edit(OfdService $ofdService)
    {
        if( $ofdService['user_id'] === Auth::id() ){
            return view('ofdService.edit', compact(['ofdService']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfdService  $ofdService
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
        }
        return redirect()->route('ofdService.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfdService  $ofdService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfdService $ofdService)
    {
        //
    }
}
