<?php

namespace App\Http\Controllers;

use App\User,
    App\University,
    App\Tag,
    App\Exercise,
    App\ExerciseLevel,
    App\ExerciseCategory,
    App\ArticleCategory,
    App\Article;

class ProfessorAdminController extends Controller
{
    public function getActivateDeactivateUser($user_id, $from_other_profile)
    {
        $from_other_profile = $from_other_profile == "true" ? true : false;

        $data = request()->only('what_to_do');

        if($from_other_profile){
            $data['what_to_do'] = 'validate_or_invalidate';
        }

        // dd($data);

        $activate_or_deactivate = '';
        $validate_or_invalidate = '';
        $prof_or_student = '';
        
        $user = User::find($user_id);

        if(!$user){
            return response()->json(['status' => 'error', 'message' => 'O utilizador seleccionado não foi encontrado. Por favor, atualize a página e tente de novo.'], 200);
        }

        // dd($data['what_to_do'], $from_other_profile, $user->isProfessor());

        if(isset($data['what_to_do']) && $data['what_to_do'] == 'activate_or_deactivate'){
            if($user->isProfessor() || $user->isPreProfessor()){
                $prof_or_student = 'professor';
            }
            else{
                $prof_or_student = 'student';
            }

            if($user->active){
                $user->active = 0;
                $activate_or_deactivate = 'deactivate';
            }
            else{
                $user->active = 1;
                $activate_or_deactivate = 'activate';
            }
        }
        else if((isset($data['what_to_do']) && $data['what_to_do'] == 'validate_or_invalidate')){
            $prof_or_student = 'professor';
            if($user->isPreProfessor()){
                $user->user_role_id = 2;
                $validate_or_invalidate = 'validate';
            }
            else{
                $user->user_role_id = 4;
                $validate_or_invalidate = 'invalidate';
            }
        }

        $user->save();

        if($from_other_profile){
            request()->session()->flash('success', 'Professor aprovado com sucesso!');
            return redirect()->back();
        }

        return response()->json([
            'status' => 'success', 
            'message' => 'Estado do utilizador atualizado com sucesso!',
            'activate_or_deactivate' => $activate_or_deactivate,
            'validate_or_invalidate' => $validate_or_invalidate,
            'prof_or_student' => $prof_or_student
        ], 200);
    }

    public function professorValidationApplyFilters()
    {
        $inputs = request()->only(
            'page',
            'settings_professors_filter_username',
            'settings_professors_filter_approval',
            'settings_professors_filter_status',
            'settings_professors_start_date',
            'settings_professors_end_date'
        );

        $professors = User::applyUsersValidationFilters($inputs, 'professors');

        $view = view()->make("users.edit-tab-contents.admin_settings.professors", [
                'professors' => $professors,
                'inputs' => $inputs
        ]);


        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
        ]);
    }

    public function studentValidationApplyFilters()
    {
        $inputs = request()->only(
            'page',
            'settings_students_filter_username',
            'settings_students_filter_status',
            'settings_students_start_date',
            'settings_students_end_date'
        );

        $students = User::applyUsersValidationFilters($inputs, 'students');

        $view = view()->make("users.edit-tab-contents.admin_settings.students", [
                'students' => $students,
                'inputs' => $inputs
        ]);

        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
        ]);
    }

    public function saveSettingsContent()
    {
        $data = request()->only('to_save', 'table_row_data_id', 'new_content_name');

        return self::manageSettingsContent('to_save', $data);
    }

    public function saveNewSettingsContent()
    {
        $data = request()->only('new_content', 'new_content_name');

        return self::manageSettingsContent('new_content', $data);
    }

    public function deleteSettingsContent()
    {
        $data = request()->only('to_delete', 'table_row_data_id');

        return self::manageSettingsContent('to_delete', $data);
    }

    public function manageSettingsContent($type, $data)
    {
        switch ($data[$type]) {
            // Universities
            case 'university':
                $content_to_refresh = 'universities';
                switch ($type) {
                    case 'to_save':
                        $content_to_update = University::find($data['table_row_data_id']);
                        $content_to_update->name = $data['new_content_name'];
                        $content_to_update->save();
                        break;
                    case 'new_content':
                        $content_to_update = University::create(['name' => $data['new_content_name']]);
                        break;
                    case 'to_delete':
                        $content_to_update = University::find($data['table_row_data_id'])->delete();
                        break;
                }
                $new_content_updated = University::get();
                break;
            // Tags
            case 'tag':
                $content_to_refresh = 'tags';
                switch ($type) {
                    case 'to_save':
                        $content_to_update = Tag::find($data['table_row_data_id']);
                        $content_to_update->name = $data['new_content_name'];
                        $content_to_update->save();
                        break;
                    case 'new_content':
                        $content_to_update = Tag::create(['name' => $data['new_content_name']]);
                        break;
                    case 'to_delete':
                        $content_to_update = Tag::find($data['table_row_data_id'])->delete();
                        break;
                }
                $new_content_updated = Tag::get();
                break;
            // Exercises Levels
            case 'exercise_level':
                $content_to_refresh = 'exercises_levels';
                switch ($type) {
                    case 'to_save':
                        $content_to_update = ExerciseLevel::find($data['table_row_data_id']);
                        $content_to_update->name = $data['new_content_name'];
                        $content_to_update->save();
                        break;
                    case 'new_content':
                        $content_to_update = ExerciseLevel::create(['name' => $data['new_content_name']]);
                        break;
                    case 'to_delete':
                        $content_to_update = ExerciseLevel::find($data['table_row_data_id'])->delete();
                        break;
                }
                $new_content_updated = ExerciseLevel::get();
                break;
            // Exercises Categories
            case 'exercise_category':
                $content_to_refresh = 'exercises_categories';
                switch ($type) {
                    case 'to_save':
                        $content_to_update = ExerciseCategory::find($data['table_row_data_id']);
                        $content_to_update->name = $data['new_content_name'];
                        $content_to_update->save();
                        break;
                    case 'new_content':
                        $content_to_update = ExerciseCategory::create(['name' => $data['new_content_name']]);
                        break;
                    case 'to_delete':
                        $content_to_update = ExerciseCategory::find($data['table_row_data_id'])->delete();
                        break;
                }
                $new_content_updated = ExerciseCategory::get();
                break;
            // Articles Categories
            case 'article_category':
                $content_to_refresh = 'articles_categories';
                switch ($type) {
                    case 'to_save':
                        $content_to_update = ArticleCategory::find($data['table_row_data_id']);
                        $content_to_update->name = $data['new_content_name'];
                        $content_to_update->save();
                        break;
                    case 'new_content':
                        $content_to_update = ArticleCategory::create(['name' => $data['new_content_name']]);
                        break;
                    case 'to_delete':
                        $content_to_update = ArticleCategory::find($data['table_row_data_id'])->delete();
                        break;
                }
                $new_content_updated = ArticleCategory::get();
                break;
        }

        $view = view()->make("users.edit-tab-contents.admin_settings.content-partials." . $content_to_refresh, [
            $content_to_refresh => $new_content_updated,
        ]);

        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
            'content_to_refresh' => $content_to_refresh
        ]);
    }

    public function approveArticleOrUser($article_id)
    {
        $data = request()->all();
        // dd($data);
        $article = Article::find($article_id);
        $user = $article->user;

        if(!$article){
            return response()->json(['status' => 'error', 'message' => 'O artigo seleccionado não foi encontrado. Por favor, atualize a página e tente de novo.'], 200);
        }

        if(!$user){
            return response()->json(['status' => 'error', 'message' => 'O utilizador autor do artigo seleccionado não foi encontrado. Por favor, atualize a página e tente de novo.'], 200);
        }

        $updated_articles = [];

        if($data['what_to_do'] == 'approve_article'){
            if($article->published){
                $article->published = 0;
            }
            else{
                $article->published = 1;
            }
            $article->save();
            $updated_articles[] = $article;
        }
        else if($data['what_to_do'] == 'approve_user'){
            if($user->can_post_articles){
                $user->can_post_articles = 0;
            }
            else{
                $user->can_post_articles = 1;
            }
            $user->save();
            foreach ($user->articles as $unapproved_article) {
                if($user->can_post_articles){
                    $unapproved_article->published = 1;
                }
                else{
                    $unapproved_article->published = 0;
                }
                $unapproved_article->save();
                $updated_articles[] = $unapproved_article;
            }
        }

        foreach(collect($updated_articles) as $updated_article){
            $view = view()->make("users.edit-tab-contents.admin_settings.single_article_table_row", [
                    'article' => $updated_article,
            ]);

            $htmls[] = $view->render();
        }

        // dd($htmls);

        // $article = Article::find($article_id);

        // $view = view()->make("users.edit-tab-contents.admin_settings.single_article_table_row", [
        //         'article' => $article,
        // ]);

        // $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'htmls' => $htmls,
            'articles_ids' => collect($updated_articles)->pluck('id')->toArray()
        ]);
    }

    public function articlesValidationApplyFilters()
    {
        $inputs = request()->only(
            'page',
            'settings_articles_filter_article_title',
            'settings_articles_filter_article_published',
            'settings_articles_filter_user_username',
            'settings_articles_filter_user_can_publish',
        );

        $articles = Article::applyArticlesValidationFilters($inputs);

        $view = view()->make("users.edit-tab-contents.admin_settings.library", [
                'articles' => $articles,
                'inputs' => $inputs
        ]);


        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
        ]);
    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }

    public function getIrreversibleActions()
    {
        $this->viewShareNotifications();
        $inputs = request()->all();

        $professors = User::whereIn('user_role_id', [1, 2, 4])
                            ->where('id', '!=', auth()->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'professors');

        $students = User::where('user_role_id', 3)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'students');

        $exercises = Exercise::orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'exercises');

        $categories = ExerciseCategory::get();
        $levels = ExerciseLevel::get();

        return view('users.irr-actions', compact('inputs', 'professors', 'students', 'exercises', 'categories', 'levels'));
    }

    public function irrActionsProfessorValidationApplyFilters()
    {
        $inputs = request()->only(
            'page',
            'settings_professors_filter_username',
            'settings_professors_filter_approval',
            'settings_professors_filter_status',
            'settings_professors_start_date',
            'settings_professors_end_date'
        );

        $professors = User::applyUsersValidationFilters($inputs, 'professors');

        $view = view()->make("global-partials.irr-actions.professors", [
                'professors' => $professors,
                'inputs' => $inputs
        ]);


        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
        ]);
    }

    public function irrActionsStudentValidationApplyFilters()
    {
        $inputs = request()->only(
            'page',
            'settings_students_filter_username',
            'settings_students_filter_status',
            'settings_students_start_date',
            'settings_students_end_date'
        );

        $students = User::applyUsersValidationFilters($inputs, 'students');

        $view = view()->make("global-partials.irr-actions.students", [
                'students' => $students,
                'inputs' => $inputs
        ]);

        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
        ]);
    }

    public function irrActionsExerciseValidationApplyFilters()
    {
        $inputs = request()->only(
            'page',
            'settings_exercises_filter_name',
            'settings_exercises_filter_category',
            'settings_exercises_filter_level',
            'settings_exercises_filter_published',
        );

        $exercises = Exercise::applyExerciseValidationFilters($inputs);

        $exercise_categories = ExerciseCategory::get();
        $exercise_levels = ExerciseLevel::get();

        $view = view()->make("global-partials.irr-actions.exercises", [
                'exercises' => $exercises,
                'categories' => $exercise_categories,
                'levels' => $exercise_levels,
                'inputs' => $inputs
        ]);

        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'html' => $html,
        ]);
    }

    public function deleteIrreversibleAction($deleteWhat, $id)
    {
        if($deleteWhat == 'professor')
        {
            User::deleteProfessor($id);
        }
        else if($deleteWhat == 'aluno')
        {
            User::deleteStudent($id);
        }
        else if($deleteWhat == 'exercicio')
        {
            Exercise::deleteExercise($id);
        }

        request()->session()->flash('success', ucfirst($deleteWhat) . ' apagado com sucesso!');

        return redirect()->to('/acoes-irreversiveis?land_on_tab=' . $deleteWhat);
    }
}
