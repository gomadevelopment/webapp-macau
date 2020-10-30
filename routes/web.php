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


Route::group(['middlewareGroups' => 'web'], function () {

    Route::get('/', function () {
        return view('homepage');
    });

    Route::post('/signup', 'UsersController@signUp');

    Route::post('/login', 'Auth\AuthController@loginPost');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/logout', 'Auth\AuthController@logout');
        Route::get('/forbidden', 'Auth\AuthController@forbidden');

        Route::get('/artigos', 'ArticlesController@index');

    });
});