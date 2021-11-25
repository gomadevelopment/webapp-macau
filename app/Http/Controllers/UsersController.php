<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Auth\Events\Registered;

use App\User,
    App\University,
    App\UserBlocked,
    App\Exercise,
    App\Tag,
    App\ExerciseLevel,
    App\ExerciseCategory,
    App\ArticleCategory,
    App\Article,
    App\NotificationType,
    App\QuestionType,
    App\Exame,
    App\Inquiry;

use DB;

class UsersController extends Controller
{
    public function index_profile($id)
    {
        $this->viewShareNotifications();
        $inputs = request()->all();

        $user = User::find($id);

        if(!empty($inputs)){
            try {
                $skip = $inputs['page'] * 4;

                $promoted_exercises = Exercise::where('user_id', $user->id)->skip($skip)->paginate(4);

                $view = view()->make("users.promoted_exercises_partial", [
                    'promoted_exercises' => $promoted_exercises,
                    'inputs' => $inputs
                ]);
                $html = $view->render();
            } catch (\Exception $e) {
                // dd($e);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocorreu um erro ao mudar de página! Por favor, atualize a página e tente de novo.'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'html' => $html,
                // 'changed_paged' => $inputs['page'] != 1 ? true : false
            ]);
        }

        if($user->id == auth()->user()->id){
            $promoted_exercises = Exercise::orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate(4);
        }
        else{
            $promoted_exercises = Exercise::orderBy('created_at', 'desc')
                                            ->where('user_id', $user->id)
                                            ->where('published', 1)
                                            ->paginate(4);
        }

        $inputs = [];

        if($user->isProfessor()){
            $levels = collect();
            $categories = collect();
            $question_types_subtypes = collect();
            $user_exercises = collect();
            $inquiries = collect();
        }
        else{
            $levels = ExerciseLevel::get();
            $categories = ExerciseCategory::get();
            $question_types_subtypes = QuestionType::with('subtypes')->get();
            $filters = ['user_id' => $user->id];
            $user_exercises = Exame::applyPerformanceFilters($filters);
            $inquiries = Inquiry::get();
        }

        return view('users.index_profile', compact(
            'user', 
            'promoted_exercises', 
            'inputs', 
            'levels', 
            'categories', 
            'question_types_subtypes', 
            'user_exercises',
            'inquiries'));
    }

    public function edit_profile($id)
    {
        $this->viewShareNotifications();
        $user = User::find($id);
        $universities = University::get();
        $classes = auth()->user()->classes;
        $students_without_class = User::usersWithOutClass();

        $professors = User::whereIn('user_role_id', [1, 2, 4])
                            ->where('id', '!=', auth()->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'professors');

        $students = User::where('user_role_id', 3)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'students');

        $tags = Tag::get();
        $exercises_levels = ExerciseLevel::get();
        $exercises_categories = ExerciseCategory::get();
        $articles_categories = ArticleCategory::get();
        $articles = Article::orderBy('created_at', 'desc')->paginate(10, ['*'], 'articles');
        $notification_types = NotificationType::get();

        $land_on_settings_tab = !empty(request()->only('land_on_settings_tab'));
        $inputs = [
            'land_on_settings_tab' => $land_on_settings_tab
        ];

        return view('users.edit_profile', compact(
            'user', 
            'universities', 
            'tags',
            'exercises_levels',
            'exercises_categories',
            'articles_categories',
            'articles',
            'notification_types',
            'classes', 
            'students_without_class', 
            'professors', 
            'students', 
            'inputs'));
    }

    public function editPost_profile($id)
    {
        $this->viewShareNotifications();
        $inputs = request()->all();

        $more_rules = [];
        if(isset($inputs['password'])){
            $more_rules['password'] = 'required|min:6|confirmed';
        }
        if(isset($inputs['second_email'])){
            $more_rules['second_email'] = ['required', 'email'];
        }
        
        $user = User::find($id);

        $validator = \Validator::make($inputs, User::rulesForEdit($id, $more_rules), User::$messages);
        if ($validator->fails()) {
            request()->session()->flash('edit_profile_error', 'Por favor, verifique os erros no formulário.');
            // request()->session()->flash('error', 'Ocorreu um erro ao atualizar o seu perfil. Por favor, tente de novo!');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('edit_profile_error', 'Por favor, verifique os erros no formulário.');
        }

        DB::beginTransaction();
        try {
            
            $user->saveEditProfile($inputs);

        } catch (\Exception $e) {

            DB::rollback();

            request()->session()->flash('edit_profile_error', 'Por favor, verifique os erros no formulário.');
            // request()->session()->flash('error', 'Ocorreu um erro ao atualizar o seu perfil. Por favor, tente de novo!');
            return redirect()
                ->back()
                ->withInput()
                ->with('edit_profile_error', 'Por favor, verifique os erros no formulário.');
        }
        DB::commit();

        request()->session()->flash('success', 'Utilizador atualizado com sucesso!');

        $universities = University::get();
        $classes = auth()->user()->classes;
        $students_without_class = User::usersWithOutClass();

        $professors = User::whereIn('user_role_id', [1, 2, 4])
                            ->where('id', '!=', auth()->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'professors');

        $students = User::where('user_role_id', 3)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, ['*'], 'students');
        
        $tags = Tag::get();
        $exercises_levels = ExerciseLevel::get();
        $exercises_categories = ExerciseCategory::get();
        $articles_categories = ArticleCategory::get();
        $articles = Article::orderBy('created_at', 'desc')->paginate(10, ['*'], 'articles');
        $notification_types = NotificationType::get();

        $land_on_settings_tab = !empty(request()->only('land_on_settings_tab'));
        $inputs = [
            'land_on_settings_tab' => $land_on_settings_tab
        ];

        return view('users.edit_profile', compact(
            'user', 
            'universities', 
            'tags',
            'exercises_levels',
            'exercises_categories',
            'articles_categories', 
            'articles', 
            'notification_types',
            'classes', 
            'students_without_class', 
            'professors', 
            'students', 
            'inputs'));
    }

    public function replaceUserAvatar()
    {
        $data = request()->all();

        $user = User::find($data['user_id']);
        
        $inputs = [
            'avatar_url' => $data['new_user_avatar']
        ];

        DB::beginTransaction();
        try {
            
            $avatar_url = $user->storeUserAvatar($inputs);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao substituir a sua fotografia. Por favor, tente de novo!']);
        }
        DB::commit();
        
        return response()->json(['status' => 'success', 'avatar_url' => $avatar_url]);
    }

    public function blockUser($user_id)
    {
        $user_to_block = User::find($user_id);

        if(auth()->user()->blockedUser($user_to_block->id)){
            auth()->user()->blockedUser($user_to_block->id)->delete();
        }
        else{
            UserBlocked::create([
                'user_id' => auth()->user()->id,
                'user_blocked_id' => $user_to_block->id
            ]);
        }

        return redirect()->to('/chat/' . $user_id);
    }

    public function applyPerformanceFilters()
    {
        $data = request()->all();

        $user_exercises = Exame::applyPerformanceFilters($data, $data['by_student_or_class']);

        return response()->json([
            'status' => 'success',
            'message' => '',
            'user_exercises' => $user_exercises,
        ]);
    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
