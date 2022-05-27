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

Auth::routes(['verify' => true]);

Route::group(['middlewareGroups' => 'web'], function () {

    Route::get('/', 'Controller@homepage')->name('homepage');
    Route::get('/locale/{locale}', 'Controller@setLocale');

    Route::post('/signup', 'Auth\RegisterController@create');

    Route::get('/login', 'Auth\AuthController@login')->name('login');
    Route::post('/login', 'Auth\AuthController@loginPost');

    Route::get('/recuperar_password', 'Auth\ForgotPasswordController@forgotPassword');
    Route::get('/redefinir_password/{token}', 'Auth\ForgotPasswordController@resetPasswordGet')->name('password.reset');
    Route::post('/redefinir_password', 'Auth\ForgotPasswordController@resetPasswordPost');

    Route::get('/resend_email_verification/{user_id}', 'Auth\VerificationController@resend');

    Route::get('/ficha-tecnica', 'Controller@technicalFile');
    Route::get('/faqs', 'Controller@faqs');
    Route::get('/privacidade', 'Controller@privacy');

    Route::group(['middleware' => ['auth', 'verified']], function () {

        Route::get('/logout', 'Auth\AuthController@logout');
        Route::get('/forbidden', 'Auth\AuthController@forbidden');

        /* 
        * MIDDLEWARE - isProfessor
        */
        Route::group(['middleware' => ['isProfessor']], function () {

            // Articles
            Route::get('/artigos/criar', 'ArticlesController@save');
            Route::post('/artigos/criar', 'ArticlesController@savePost');
            Route::get('/artigos/editar/{id}', 'ArticlesController@save');
            Route::post('/artigos/editar/{id}', 'ArticlesController@savePost');
            // Route::post('/artigos/apagar/{id}', 'ArticlesController@delete');
            Route::get('/artigos/get_article_poster/{id}', 'ArticlesController@getArticlePoster');
            Route::get('/artigos/get_article_medias/{id}', 'ArticlesController@getArticleMedias');

            // Exercises
            Route::get('/exercicios/detalhe/{id}', 'ExercisesController@details');
            Route::get('/exercicios/criar', 'ExercisesController@save');
            Route::post('/exercicios/criar', 'ExercisesController@savePost');
            Route::get('/exercicios/editar/{id}', 'ExercisesController@save');
            Route::post('/exercicios/editar/{id}', 'ExercisesController@savePost');
            // Route::post('/exercicios/apagar/{id}', 'ExercisesController@delete');
            Route::post('/exercicios/clonar/{id}', 'ExercisesController@cloneExercise');
            Route::get('/exercicios/get_exercise_medias', 'ExercisesController@getExerciseMedias');
            Route::get('/exercicios/get_exercise_medias/{id}', 'ExercisesController@getExerciseMedias');
            Route::get('/exercicios/get_exercise_presentation_image', 'ExercisesController@getExercisePresentationImage');
            Route::get('/exercicios/get_exercise_presentation_image/{id}', 'ExercisesController@getExercisePresentationImage');

            Route::get('/exercicios/corrigir/{exame_id}/aluno/{student_id}', 'ExamesController@profCorrectionExameGet');
            Route::post('/exercicios/corrigir/{exame_id}/aluno/{student_id}', 'ExamesController@profCorrectionExamePost');

            // Exercises - Questions
            Route::get('/exercicios/{exercise_id}/questao/criar', 'QuestionsController@saveQuestion');
            Route::post('/exercicios/{exercise_id}/questao/criar', 'QuestionsController@savePostQuestion');
            Route::get('/exercicios/{exercise_id}/questao/editar/{question_id}', 'QuestionsController@saveQuestion');
            Route::post('/exercicios/{exercise_id}/questao/editar/{question_id}', 'QuestionsController@savePostQuestion');
            Route::get('/exercicios/{exercise_id}/questao/modelo/{question_id}/criar', 'QuestionsController@loadSaveQuestionModel');
            Route::get('/exercicios/editar/{exercise_id}/apagar/{question_id}', 'QuestionsController@deleteQuestion');

            // Classes
            Route::post('/create_class', 'ClassesController@createClass');
            Route::get('/insert_students_in_class', 'ClassesController@insertStudentsInClass');
            Route::get('/remove_student_from_class/{id}', 'ClassesController@removeStudentFromClass'); // id = student_id

            // Questions Menu List
            Route::get('/questoes', 'QuestionsController@getQuestionsMenuList');

            /* 
            * MIDDLEWARE - isAdmin
            */
            Route::group(['middleware' => ['isAdmin']], function () {

                // Professor Admin
                Route::get('/activate_deactivate_user/{user_id}/{from_other_profile}', 'ProfessorAdminController@getActivateDeactivateUser'); // id = student_id
                Route::get('/professors_validation_filters', 'ProfessorAdminController@professorValidationApplyFilters');
                Route::get('/students_validation_filters', 'ProfessorAdminController@studentValidationApplyFilters');
                // Route::get('/student_validation_filters', 'ProfessorAdminController@studentValidationApplyFilters');

                Route::get('/save_settings_content', 'ProfessorAdminController@saveSettingsContent');
                Route::get('/save_new_settings_content', 'ProfessorAdminController@saveNewSettingsContent');
                Route::get('/delete_settings_content', 'ProfessorAdminController@deleteSettingsContent');

                Route::get('/approve_articles/{article_id}', 'ProfessorAdminController@approveArticleOrUser');
                Route::get('/articles_validation_filters', 'ProfessorAdminController@articlesValidationApplyFilters');

                Route::get('/acoes-irreversiveis', 'ProfessorAdminController@getIrreversibleActions');
                Route::get('/acoes-irreversiveis/professors_validation_filters', 'ProfessorAdminController@irrActionsProfessorValidationApplyFilters');
                Route::get('/acoes-irreversiveis/students_validation_filters', 'ProfessorAdminController@irrActionsStudentValidationApplyFilters');
                Route::get('/acoes-irreversiveis/exercises_validation_filters', 'ProfessorAdminController@irrActionsExerciseValidationApplyFilters');

                Route::get('/acoes-irreversiveis/apagar/{deleteWhat}/{id}', 'ProfessorAdminController@deleteIrreversibleAction');

            });

        });

        /* 
        * MIDDLEWARE - isStudent
        */
        Route::group(['middleware' => ['isStudent']], function () {

            // Perform Exames
            Route::get('/exercicios/auto-exercicio', 'ExercisesController@getAutoExercise');
            Route::get('/exercicios/realizar/{exercise_id}', 'ExamesController@performExercise');
            Route::post('/exercicios/realizar/{exercise_id}', 'ExamesController@performPostExercise');
            Route::get('/notify/exame_requires_evaluation/{exame_id}', 'NotificationsController@requireExameCorrection');
            Route::get('/exercicios/realizar/update_pause_timer/{exame_id}', 'ExamesController@updatePauseTimers');
        });

        /* 
        * All Users Routes
        */

        // Articles
        Route::get('/artigos', 'ArticlesController@index');
        Route::get('/artigos/detalhe/{id}', 'ArticlesController@details');
        Route::post('/artigos/artigo_favorito', 'ArticlesController@toggleFavorite');

        // Exercises
        Route::get('/exercicios', 'ExercisesController@index');
        Route::post('/exercicios/exercicio_favorito', 'ExercisesController@toggleFavorite');

        // Classroom
        Route::get('/sala_de_aula', 'ClassroomController@index');
        Route::get('/students_class_select/{id}', 'ClassroomController@studentsClassSelect');
        // Professor
        Route::get('/get_student_exercises_by_class/{student_class_id}', 'ClassroomController@getStudentExercisesByClass');
        // Student
        Route::get('/get_student_exercises', 'ClassroomController@getStudentExercises');
        
        
        // Users Profile
        Route::get('/perfil/{id}', 'UsersController@index_profile');
        // Route::get('/perfil/{id}/update_promoted_exercises', 'UsersController@index_profile');
        Route::get('/perfil/editar/{id}', 'UsersController@edit_profile'); // Adicionar {id}
        Route::post('/perfil/editar/{id}', 'UsersController@editPost_profile'); // Adicionar {id}
        Route::post('/replace_user_avatar', 'UsersController@replaceUserAvatar');
        // Route::get('/update_promoted_exercises/{id}', 'UsersController@index_profile');

        // Chat
        Route::get('/chat', 'ChatController@getChatRoom');
        Route::get('/chat/{id}', 'ChatController@getChat');
        Route::get('/chat_de_grupo', 'ChatController@getGroupChat');
        Route::get('/chat_de_grupo/{id}', 'ChatController@redirectToGroupChat');
        Route::post('/chat/message', 'ChatController@postChatMessage');
        Route::get('/chat/messages/{id}', 'ChatController@getChatMessages'); // id = chat_id
        Route::get('/chat_search_users', 'ChatController@searchUsers');
        Route::get('/block_user/{id}', 'UsersController@blockUser'); // id = chat_id
        Route::get('/delete_group_chat', 'ChatController@deleteGroupChat');

        // Notifications
        Route::get('/notifications_mark_as_read', 'NotificationsController@markNotificationsAsRead');
        Route::get('/update_classroom_notifications', 'NotificationsController@updateNotifications');
        Route::get('/turn_notification_types_on_off/{notification_type_id}', 'NotificationsController@turnNotificationTypesOnOff');

        // Performance
        Route::get('/performance_filters', 'UsersController@applyPerformanceFilters');

    });
});
