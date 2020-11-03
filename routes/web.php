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

    Route::get('/login', 'Auth\AuthController@login')->name('login');
    Route::post('/login', 'Auth\AuthController@loginPost');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/logout', 'Auth\AuthController@logout');
        Route::get('/forbidden', 'Auth\AuthController@forbidden');

        Route::get('/artigos', 'ArticlesController@index');
        Route::get('/artigos/detalhe', 'ArticlesController@details'); // Adicionar {id}
        Route::get('/artigos/criar', 'ArticlesController@save');
        Route::post('/artigos/criar', 'ArticlesController@savePost');
        Route::get('/artigos/editar', 'ArticlesController@save'); // Adicionar {id}
        Route::post('/artigos/editar', 'ArticlesController@savePost'); // Adicionar {id}

    });
});