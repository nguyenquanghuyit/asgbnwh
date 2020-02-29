<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllCode','Api\vwCurrentCodeController@index');
Route::post('getInfo','Api\vwCurrentCodeController@show');

/*Route::get('getInfo',function(){
    $dt=DB::table("tbl_order")->get();
    return $dt;
});*/
