<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\SberbankController;
use \App\Http\Controllers\Api\PaysystemController;
use \App\Http\Controllers\Api\BunchController;
use \App\Http\Controllers\Api\OfdServiceController;
use \App\Http\Controllers\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/register', Auth\RegisterController::class);
Route::post('auth/login', Auth\LoginController::class);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResources(['paysystem' => PaysystemController::class]);
    Route::apiResources(['bunch' => BunchController::class]);
    Route::apiResources(['ofdService' => OfdServiceController::class]);
    Route::apiResources(['ofdservice' => OfdServiceController::class]);
});



//Route::post('paysystem', \App\Http\Controllers\PaysystemController::class);

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::apiResources([
    'sberbank' => SberbankController::class
]);
