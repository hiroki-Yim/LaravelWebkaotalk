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

Route::get('/board', 'viewController@boardView');

Route::get('board', 'boardController@index');

Route::get('view', 'boardController@view');

Route::get('chats', 'boardController@chats');

Route::get('write', 'boardController@write');    //get = 정보요청
                                                 //crud = POST요청
Route::post('wirte', 'boardController@update');

Route::post('delete', 'boardController@delete');

// Route::resource('user', 'UserController');

Auth::routes(); //

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', function(){
    return view('welcome');
});

Route::get('/registerForm', 'userController@registerForm'); 
