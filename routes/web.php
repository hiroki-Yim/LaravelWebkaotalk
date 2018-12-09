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
//Route::resource('board', 'boardController', except예외처리 할 메서드); 자동연결 -resource

Auth::routes(); // Auth관련 기능 연결

//
Route::resource('board', 'boardController')->middleware('auth');
Route::post('/postajax', 'AjaxController@search');  // ajax test

//comment Routing
Route::resource('comment', 'commentController',[   
    'only'=>[ 'destroy', 'update']    //해당함수만 라우팅함
]);
Route::resource('board.comment', 'commentController',[
    'only'=> ['store']
]);

//auth middleware route
Route::get('loginAuth', function(){return view('auth.login2');});

Route::get('find', 'boardController@find');
Route::get('more', function(){return view('more.more');});

Route::get('maps', function(){return view('more.maps');});

//profile
Route::get('profile', 'viewController@profile')->middleware('auth');
Route::get('profileEdit', 'viewController@editProfile')->middleware('auth');

//kakao login
Route::get('loginForKakao', 'kakaoLoginController@index');
Route::get('auth/loginForKakao', 'kakaoLoginController@redirectToProvider');
Route::get('/auth/kakaologincallback', 'kakaoLoginController@handleProviderCallback');


Route::resource('chats', 'chatsController')->middleware('auth');

//puhser chat
Route::get('chatting', 'chatsController@chatting');
Route::get('messages', 'chatsController@fetchMessages');//모든 채팅 메시지 가져오는 로직
#send Message is error -> route/api

//send register mail
Route::get('register/{code}', 'Auth\RegisterController@confirm')->name('register.confirm')->where('code','[\pL-\pN]{60}');

//File&Img_upload
Route::post('/imgUpload','fileController@imageUpload')->name('imgUpload');
Route::post('/fileUpload', 'fileController@fileUpload')->name('fileUpload');
Route::delete('/deleteFile/{id}', 'fileController@deleteFile');
Route::get('/downloadFile/{file}', 'fileController@downloadFile');

//친구관리
Route::get('/friends', 'FriendController@index')->middleware('auth');
