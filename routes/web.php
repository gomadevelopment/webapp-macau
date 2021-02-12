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

    Route::get('/', 'Controller@homepage');
    Route::get('/locale/{locale}', 'Controller@setLocale');

    Route::post('/signup', 'UsersController@signUp');

    Route::get('/login', 'Auth\AuthController@login')->name('login');
    Route::post('/login', 'Auth\AuthController@loginPost');

    Route::get('/recuperar_password', 'Auth\ForgotPasswordController@forgotPassword');
    Route::get('/redefinir_password/{token}', 'Auth\ForgotPasswordController@resetPasswordGet')->name('password.reset');
    Route::post('/redefinir_password', 'Auth\ForgotPasswordController@resetPasswordPost');

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
        // Route::post('/artigos/apagar/{id}', 'ArticlesController@delete');
        Route::post('/artigos/artigo_favorito', 'ArticlesController@toggleFavorite');

        Route::get('/artigos/get_article_poster/{id}', 'ArticlesController@getArticlePoster');
        Route::get('/artigos/get_article_medias/{id}', 'ArticlesController@getArticleMedias');

        // Exercises
        Route::get('/exercicios', 'ExercisesController@index');
        Route::get('/exercicios/detalhe/{id}', 'ExercisesController@details');
        Route::get('/exercicios/criar', 'ExercisesController@save');
        Route::post('/exercicios/criar', 'ExercisesController@savePost');
        Route::get('/exercicios/editar/{id}', 'ExercisesController@save');
        Route::post('/exercicios/editar/{id}', 'ExercisesController@savePost');
        // Route::post('/exercicios/apagar/{id}', 'ExercisesController@delete');
        Route::post('/exercicios/exercicio_favorito', 'ExercisesController@toggleFavorite');
        Route::post('/exercicios/clonar/{id}', 'ExercisesController@cloneExercise');

        Route::get('/exercicios/get_exercise_medias/{id}', 'ExercisesController@getExerciseMedias');

        // Exercises - Questions
        Route::get('/exercicios/{exercise_id}/questao/criar', 'QuestionsController@saveQuestion');
        Route::post('/exercicios/{exercise_id}/questao/criar', 'QuestionsController@savePostQuestion');
        Route::get('/exercicios/{exercise_id}/questao/editar/{question_id}', 'QuestionsController@saveQuestion');
        Route::post('/exercicios/{exercise_id}/questao/editar/{question_id}', 'QuestionsController@savePostQuestion');
        Route::get('/exercicios/{exercise_id}/questao/modelo/{question_id}/criar', 'QuestionsController@loadSaveQuestionModel');
        Route::get('/exercicios/editar/{exercise_id}/apagar/{question_id}', 'QuestionsController@deleteQuestion');

        Route::get('/exercicios/realizar/{exercise_id}', 'ExercisesController@performExercise'); // Adicionar {id}
        Route::post('/exercicios/realizar/{exercise_id}', 'ExercisesController@performPostExercise'); // Adicionar {id}

        // Classroom
        Route::get('/sala_de_aula', 'ClassroomController@index');
        Route::get('/students_class_select/{id}', 'ClassroomController@studentsClassSelect');
        
        // Users Profile
        Route::get('/perfil/{id}', 'UsersController@index_profile');
        // Route::get('/perfil/{id}/update_promoted_exercises', 'UsersController@index_profile');
        Route::get('/perfil/editar/{id}', 'UsersController@edit_profile'); // Adicionar {id}
        Route::post('/perfil/editar/{id}', 'UsersController@editPost_profile'); // Adicionar {id}
        Route::post('/replace_user_avatar', 'UsersController@replaceUserAvatar');
        // Route::get('/update_promoted_exercises/{id}', 'UsersController@index_profile');

        // Chat
        Route::get('/chat/{id}', 'ChatController@getChat');
        Route::get('/chat_de_grupo', 'ChatController@getGroupChat');
        Route::get('/chat_de_grupo/{id}', 'ChatController@redirectToGroupChat');
        Route::post('/chat/message', 'ChatController@postChatMessage');
        Route::get('/chat/messages/{id}', 'ChatController@getChatMessages'); // id = chat_id
        Route::get('/chat_search_users', 'ChatController@searchUsers');
        Route::get('/block_user/{id}', 'UsersController@blockUser'); // id = chat_id

        // Classes
        Route::post('/create_class', 'ClassesController@createClass');
        Route::get('/insert_students_in_class', 'ClassesController@insertStudentsInClass');
        Route::get('/remove_student_from_class/{id}', 'ClassesController@removeStudentFromClass'); // id = student_id

        // Notifications
        Route::get('/notifications_mark_as_read', 'NotificationsController@markNotificationsAsRead');
        Route::get('/update_classroom_notifications', 'NotificationsController@updateNotifications');

    });
});