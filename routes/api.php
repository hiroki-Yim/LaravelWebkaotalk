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

//puhser chat

Route::post('messages', 'chatsController@sendMessage'); //새 메시지 보내기

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
