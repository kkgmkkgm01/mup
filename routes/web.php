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

Route::get(
    '/', function () {
        return view('top');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('posts', 'PostController');

// Route::resource('items', 'ItemController');

Route::get(
    'i/{id}', function ($id) {
        return 'Item '.$id;
    }
);

Route::post('items', 'ItemController@store')->name('items.store');
Route::get('items', 'ItemController@index')->name('items.index');
Route::get('items/create', 'ItemController@create')->name('items.create');
Route::match(['put', 'patch'], 'items/{key}', 'ItemController@updatefromkey')->name('items.updatefromkey');
Route::get('items/{key}', 'ItemController@showfromkey')->name('items.showfromkey');
//Route::delete('items/{id}', 'ItemController@destroy')->name('items.destroy');
Route::delete('items/{key}', 'ItemController@destroyfromkey')->name('items.destroyfromkey');
Route::get('items/{key}/edit', 'ItemController@editfromkey')->name('items.editfromkey');


//コメント一覧のHTML出力
Route::get('items/{key}/comments','Item_commentController@main');
//JSON API※使用しないことに※使用しないことに
Route::get('items/{key}/comments/json','Item_commentController@json');
//APIを呼び出す一覧用※使用しないことに
Route::get('items/{key}/comments/ajax','Item_commentController@ajax');

//仮会員登録
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

//本会員登録
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

//ソーシャルログイン
Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');


