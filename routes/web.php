<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'mainController@main');  // root : app->Http->Controller->mainController.php    //controller's name @ method's name

// Route::get('/board', 'viewController@boardView');
// Route::get('chats', 'boardController@chats');
// Route::get('write', 'boardController@write');    //get = 정보요청                                                 //crud = POST요청
// Route::post('wirte', 'boardController@update');
// Route::post('delete', 'boardController@delete');
//Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('board', 'boardController', except예외처리 할 메서드);    //resource하면 board.index,create,destroy,update등등 자동연결

Auth::routes(); // Auth관련 기능 연결

Route::resource('board', 'boardController');
Route::resource('chats', 'chatController');

Route::get('find', 'boardController@find');
Route::get('more', function(){return view('more.more');});

Route::get('maps', function(){return view('more.maps');});
Route::get('profile', 'viewController@profile');



//kakao login
Route::get('loginForKakao', 'kakaoLoginController@index');
Route::get('auth/loginForKakao', 'kakaoLoginController@redirectToProvider');
Route::get('/auth/kakaologincallback', 'kakaoLoginController@handleProviderCallback');