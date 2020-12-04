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

        // Articles
        Route::get('/artigos', 'ArticlesController@index');
        Route::get('/artigos/detalhe/{id}', 'ArticlesController@details');
        Route::get('/artigos/criar', 'ArticlesController@save');
        Route::post('/artigos/criar', 'ArticlesController@savePost');
        Route::get('/artigos/editar/{id}', 'ArticlesController@save');
        Route::post('/artigos/editar/{id}', 'ArticlesController@savePost');
        Route::post('/artigos/apagar/{id}', 'ArticlesController@delete');
        Route::post('/artigos/artigo_favorito', 'ArticlesController@toggleFavorite');

        Route::get('/artigos/get_article_poster/{id}', 'ArticlesController@getArticlePoster');
        Route::get('/artigos/get_article_medias/{id}', 'ArticlesController@getArticleMedias');

        // Exercises
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

        // Classroom
        Route::get('/sala_de_aula', 'ClassroomController@index');
        
        // Users Profile
        Route::get('/perfil/{id}', 'UsersController@index_profile');
        Route::get('/perfil/editar/{id}', 'UsersController@edit_profile'); // Adicionar {id}
        Route::post('/perfil/editar/{id}', 'UsersController@editPost_profile'); // Adicionar {id}
        Route::post('/replace_user_avatar', 'UsersController@replaceUserAvatar');

        // Chat
        Route::get('/chat/{id}', 'ChatController@getChat');
        Route::get('/chat_de_grupo', 'ChatController@getGroupChat');
        Route::get('/chat_de_grupo/{id}', 'ChatController@redirectToGroupChat');
        Route::post('/chat/message', 'ChatController@postChatMessage');
        Route::get('/chat/messages/{id}', 'ChatController@getChatMessages'); // id = chat_id
        Route::get('/chat_search_users', 'ChatController@searchUsers');
        Route::get('/block_user/{id}', 'UsersController@blockUser'); // id = chat_id

    });
});