<?php

//use App\Http\Controllers\Api\v1\NumberController;
//use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("/auth/login", 'AuthController@login');
Route::post("/auth/logup", 'AuthController@logup');
Route::post("/auth/recover", 'AuthController@recover');
Route::get("/auth/check", 'AuthController@check');

Route::apiResources([
    'numbers'=>NumberController::class
]);
