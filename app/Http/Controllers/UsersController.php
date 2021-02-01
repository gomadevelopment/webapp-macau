<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User,
    App\University,
    App\UserBlocked,
    App\Exercise;

use DB;

class UsersController extends Controller
{
    
    public function signUp()
    {
        $inputs = request()->all();

        $validator = \Validator::make($inputs, User::$rulesForAdd, User::$messages);

        if ($validator->fails()) {
            $signup_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Por favor, verifique os erros no formulário.' 
                                : 'Please, check the errors in the form.';
            request()->session()->flash('signup_error', $signup_error);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('signup_error', $signup_error);
        }

        $new_user = User::create([
            'username' => $inputs["username"],
            'email' => $inputs["email"],
            'password' => bcrypt($inputs["password"]),
            'user_role_id' => $inputs["professor_or_student"] == 'professor' ? 2 : 3
        ]);

        return redirect()->to('/');
    }

    public function index_profile($id)
    {
        $this->viewShareNotifications();
        $inputs = request()->all();

        $user = User::find($id);
        // dd($user, $inputs);
        if(!empty($inputs)){
            // dd($inputs);
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

        $inputs['page'] = 1;

        return view('users.index_profile', compact('user', 'promoted_exercises', 'inputs'));
    }

    public function edit_profile($id)
    {
        $this->viewShareNotifications();
        $user = User::find($id);
        $universities = University::get();
        $classes = auth()->user()->classes;
        $students_without_class = User::usersWithOutClass();

        return view('users.edit_profile', compact('user', 'universities', 'classes', 'students_without_class'));
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

        $validator = \Validator::make($inputs, User::rulesForEdit(auth()->user()->id, $more_rules), User::$messages);

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

        return view('users.edit_profile', compact('user', 'universities', 'classes', 'students_without_class'));
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

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
