<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        /*$credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);*/
        if (Auth::attempt($credentials)) {
            //$userCreateToken = Str::random(80);
            //User::where("id", Auth::user()->id)->update(["api_token" => $userCreateToken]);

            Auth::user()->tokens()->delete();
            $device = substr($request->userAgent() ?? '', 0, 255);
            return response()->json([
                'access_token' => Auth::user()->createToken($device)->plainTextToken,
            ], Response::HTTP_CREATED);
/*
            return response()->json([
                'api_token' => $userCreateToken,
            ], Response::HTTP_ACCEPTED);*/
        }
        return response()->json([
            'message' => 'Not valid login or password',
            'errors' => 'invalid login or password'
        ], Response::HTTP_UNAUTHORIZED);
    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
