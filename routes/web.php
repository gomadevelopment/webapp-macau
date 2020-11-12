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

        Route::get('/exercicios', 'ExercisesController@index');
        Route::get('/exercicios/criar', 'ExercisesController@save');
        Route::post('/exercicios/criar', 'ExercisesController@savePost');
        Route::get('/exercicios/editar', 'ExercisesController@save'); // Adicionar {id}
        Route::post('/exercicios/editar', 'ExercisesController@savePost'); // Adicionar {id}

        Route::get('/exercicios/questao/criar', 'ExercisesController@saveQuestion');
        Route::get('/exercicios/questao/criar', 'ExercisesController@savePostQuestion');
        Route::get('/exercicios/questao/editar', 'ExercisesController@saveQuestion'); // Adicionar {id}
        Route::get('/exercicios/questao/editar', 'ExercisesController@savePostQuestion'); // Adicionar {id}

        Route::get('/exercicios/realizar', 'ExercisesController@performExercise'); // Adicionar {id}
        Route::post('/exercicios/realizar', 'ExercisesController@performPostExercise'); // Adicionar {id}

        Route::get('/sala_de_aula', 'ClassroomController@index');

        
        Route::get('/perfil', 'UsersController@index_profile');
        Route::get('/perfil/editar', 'UsersController@edit_profile'); // Adicionar {id}
        Route::post('/perfil/editar', 'UsersController@editPost_profile'); // Adicionar {id}

    });
});