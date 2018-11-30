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

//get = 정보요청, crud = POST요청
//Route::resource('board', 'boardController', except예외처리 할 메서드);  //resource하면 board.index,create,destroy,update등등 자동연결 -resource

Auth::routes(); // Auth관련 기능 연결

Route::resource('board', 'boardController');
Route::post('/postajax', 'AjaxController@search');

Route::get('find', 'boardController@find');
Route::get('more', function(){return view('more.more');});

Route::get('maps', function(){return view('more.maps');});
Route::get('profile', 'viewController@profile');
Route::get('profileEdit', 'viewController@editProfile');

//kakao login
Route::get('loginForKakao', 'kakaoLoginController@index');
Route::get('auth/loginForKakao', 'kakaoLoginController@redirectToProvider');
Route::get('/auth/kakaologincallback', 'kakaoLoginController@handleProviderCallback');


Route::resource('chats', 'chatsController');//->middleware('verified') activated 기준으로 못주나? 궁금

//puhser chat
Route::get('chatting', 'chatsController@chatting');
Route::get('messages', 'chatsController@fetchMessages');//모든 채팅 메시지 가져오는 로직
Route::post('messages', 'chatsController@sendMessage'); //새 메시지 보내기

//send register mail
Route::get('register/{code}', 'Auth\RegisterController@confirm')->name('register.confirm');

//File&Img_upload
Route::post('/imgUpload','fileController@imageUpload')->name('imgUpload');

