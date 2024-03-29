<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;  
use Illuminate\Support\Facades\Storage;

use App\Exercise,
    App\ExerciseCategory,
    App\ExerciseLevel,
    App\ExerciseFavorite,
    App\ExerciseMedia,
    App\ExerciseTag,
    App\Tag,
    App\User,
    App\Inquiry;

use DB;

class ExercisesController extends Controller
{
    public function __construct()
    {
        view()->share('topNavBarOption', 'exercises');
    }

    public function index()
    {
        $this->viewShareNotifications();
        $inputs = request()->all();

        $exercises_categories = ExerciseCategory::get();
        $exercises_levels = ExerciseLevel::get();
        $tags = Tag::get();
        if(auth()->user()->isStudent()){
            $professors = User::where('user_role_id', '!=', 3)->get();
        }
        else{
            $professors = User::where('id', '!=', auth()->user()->id)->where('user_role_id', '!=', 3)->get();
        }
        if(!empty($inputs)){
            try {
                // Delete Exercise
                if(isset($inputs['exercise_to_delete_id']) && $inputs['exercise_to_delete_id']){
                    $id = $inputs['exercise_to_delete_id'];
                    $exercise = Exercise::find($id);

                    if (!$exercise) {
                        return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao apagar este exercício. Por favor, tente de novo!'], 200);
                    }

                    if($exercise->exames->count()){
                        return response()->json(
                            ['status' => 'error', 
                            'message' => 'Não é possível apagar este exercício pois já tem exames de alunos associados.
                            Se pretende esconder o exercício dos alunos, cancele a publicação do mesmo.'], 
                            200);
                    }

                    DB::beginTransaction();
                    try{
                        foreach(ExerciseTag::where('exercise_id', $exercise->id)->get() as $exercise_tag){
                            $exercise_tag->delete();
                        }
                        foreach(ExerciseFavorite::where('exercise_id', $exercise->id)->get() as $exercise_fav){
                            $exercise_fav->delete();
                        }
                        $exercise->medias()->delete();
                        foreach($exercise->questions as $question){
                            foreach($question->question_items as $question_item){
                                if($question_item->question_item_media){
                                    $question_item->question_item_media->delete();
                                }
                                $question_item->delete();
                            }
                            Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$question->id);
                            $question->delete();
                        }
                        $exercise->delete();
                    }catch (\Exception $e) {
                        // dd($e);
                        DB::rollback();
                        return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao apagar este exercício. Por favor, tente de novo!'], 200);
                    }
                    DB::commit();
                }

                $exercises = Exercise::applyFilters($inputs);

                foreach($exercises as $exercise){
                    $exercise['is_exercise_favorite'] = $exercise->is_exercise_favorite();
                    $exercise['evaluation_median'] = $exercise->evaluationMedia();
                }

                $exercises->withPath('/exercicios');

                $view = view()->make("exercises.exercises_list_partial", [
                    'exercises' => $exercises,
                    'exercises_categories' => $exercises_categories,
                    'exercises_levels' => $exercises_levels,
                    'tags' => $tags,
                    'professors' => $professors,
                    'inputs' => $inputs
                ]);
                $html = $view->render();
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocorreu um erro ao aplicar os filtros! Por favor, atualize a página e tente de novo.'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => isset($inputs['exercise_to_delete_id']) && $inputs['exercise_to_delete_id'] ? 'Exercício removido com sucesso!' : null,
                'html' => $html,
                // 'changed_paged' => $inputs['page'] != 1 ? true : false
            ]);
        }

        $exercises = Exercise::orderBy('created_at', 'desc')
                                ->where(function ($query) {
                                    $query->where('published', 1);
                                })->orWhere(function ($query) {
                                    $query->where('published', 0)
                                        ->where('user_id', auth()->user()->id);
                                })
                                ->paginate(4);

        foreach($exercises as $exercise){
            $exercise['is_exercise_favorite'] = $exercise->is_exercise_favorite();
            $exercise['evaluation_median'] = $exercise->evaluationMedia();
        }

        $inputs['page'] = 1;
        $inputs['exercise_order_by_date_asc'] = 'off';
        $inputs['exercise_order_by_date_desc'] = 'off';
        $inputs['all_levels'] = 'on';
        $inputs['all_categories'] = 'on';
        $inputs['show_all'] = 'on';

        return view('exercises.index', compact('exercises', 'exercises_categories', 'exercises_levels', 'tags', 'professors', 'inputs'));
    }

    public function details($id)
    {
        $this->viewShareNotifications();
        $exercise = Exercise::find($id);

        if(!$exercise){
            request()->session()->flash('error', 'Ocorreu um erro ao visualizar este exercício. Por favor, tente de novo!');
            return redirect()
                    ->back()
                    ->withErrors();
        }

        $exercises_categories = ExerciseCategory::get();
        $exercises_levels = ExerciseLevel::get();
        $tags = Tag::get();
        $clonable_exercises = Exercise::where('can_clone', 1)->get();

        $details_page = true;
        $land_on_structure_tab = false;

        return view('exercises.save', compact('exercise', 'exercises_categories', 'exercises_levels', 'tags', 'clonable_exercises', 'details_page', 'land_on_structure_tab'));
    }

    public function save($id = null)
    {
        $this->viewShareNotifications();
        $exercise = $id ? Exercise::find($id) : new Exercise;

        $exercises_categories = ExerciseCategory::get();
        $exercises_levels = ExerciseLevel::get();
        $tags = Tag::get();
        $clonable_exercises = Exercise::where('can_clone', 1)->get();

        $inputs = request()->only('land_on_structure_tab');
        $land_on_structure_tab = isset($inputs['land_on_structure_tab']) && $inputs['land_on_structure_tab'] == "true" ? true : false;

        return view('exercises.save', compact('exercise', 'exercises_categories', 'exercises_levels', 'tags', 'clonable_exercises', 'land_on_structure_tab'));
    }

    public function savePost($id = null)
    {
        $inputs = request()->all();

        $exercise = $id ? Exercise::find($id) : new Exercise;
        // dd($inputs);
        if(isset($inputs['from_structure_tab'])){
            $exercise->published = isset($inputs['publish_exam']) ? 1 : 0;
            $exercise->save();

            request()->session()->flash('success', 'Exercício criado/atualizado com sucesso!');

            return redirect()->to('/exercicios');
        }

        $rules = $id ? Exercise::rulesForEdit() : Exercise::$rulesForAdd;

        $validator = \Validator::make($inputs, Exercise::rulesForEdit(), Exercise::$messages);

        if ($validator->fails()) {
            request()->session()->flash('save_exercise_error', 'Por favor, verifique os erros no formulário.');
            request()->session()->flash('error', 'Ocorreu um erro ao criar/editar o exercicio. Por favor, tente de novo!');

            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Ocorreu um erro ao criar/editar o exercicio. Por favor, verifique os erros no formulário.'
            ]);
        }

        DB::beginTransaction();
        try {
            
            $exercise->saveExercise($inputs);

        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();

            request()->session()->flash('save_exercise_error', 'Por favor, verifique os erros no formulário.');
            request()->session()->flash('error', 'Ocorreu um erro ao criar/editar o exercicio. Por favor, tente de novo!');
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao criar/editar o exercicio. Por favor, verifique os erros no formulário.'
            ]);
        }
        DB::commit();

        request()->session()->flash('success', 'Exercício criado/atualizado com sucesso!');

        return response()->json([
            'status' => 'success',
            'url' => '/exercicios/editar/' . $exercise->id,
            'ex_id' => $exercise->id
        ]);
    }

    public function toggleFavorite()
    {
        $data = request()->only('exercise_id', 'toggle');
        
        $exercise = Exercise::find($data['exercise_id']);

        if($data['toggle'] == 'on'){
            ExerciseFavorite::create([
                'exercise_id' => $exercise->id,
                'user_id' => auth()->user()->id
            ]);
        }
        else {
            ExerciseFavorite::where('exercise_id', $exercise->id)->where('user_id', auth()->user()->id)->delete();
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function cloneExercise($exercise_id)
    {
        $exercise = Exercise::find($exercise_id);
        DB::beginTransaction();
        try {
            
            $exercise_clone = $exercise->replicate();
            $exercise_clone->user_id = auth()->user()->id;
            $exercise_clone->push();
            foreach ($exercise->exercise_tags as $tag){
                $exercise_clone->exercise_tags()->attach($tag);
            }
            // foreach ($exercise->medias->get() as $media) {
            //     $media_clone = $media->replicate();
            //     $exercise_clone->medias()->save($media_clone);
            // }
            if($exercise->presentation_image){
                $fromPath = public_path('webapp-macau-storage/exercises/'.$exercise->id.'/presentation_image');
                $toPath = public_path('webapp-macau-storage/exercises/'.$exercise_clone->id.'/presentation_image');
                File::copyDirectory($fromPath, $toPath);
            }
            if($exercise->medias){
                $media_clone = $exercise->medias->replicate();
                $exercise_clone->medias()->save($media_clone);
                $fromPath = public_path('webapp-macau-storage/exercises/'.$exercise->id.'/medias');
                $toPath = public_path('webapp-macau-storage/exercises/'.$exercise_clone->id.'/medias');
                File::copyDirectory($fromPath, $toPath);
            }
            foreach ($exercise->questions()->get() as $question) {
                $question_clone = $question->replicate();
                $exercise_clone->questions()->save($question_clone);
                if($question->description_image_url){
                    $fromPath = public_path('webapp-macau-storage/questions/'.$question->id.'/description_image');
                    $toPath = public_path('webapp-macau-storage/questions/'.$question_clone->id.'/description_image');
                    File::copyDirectory($fromPath, $toPath);
                }
                if($question->question_items){
                    foreach ($question->question_items as $question_item) {
                        $question_item_clone = $question_item->replicate();
                        $question_clone->question_items()->save($question_item_clone);
                        if($question_item->question_item_media){
                            $question_item_media_clone = $question_item->question_item_media->replicate();
                            $question_item_clone->question_item_media()->save($question_item_media_clone);
                            $fromPath = public_path('webapp-macau-storage/questions/'.$question->id.'/question_item/' . $question_item->id);
                            $toPath = public_path('webapp-macau-storage/questions/'.$question_clone->id.'/question_item/' . $question_item_clone->id);
                            File::copyDirectory($fromPath, $toPath);
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            request()->session()->flash('error', 'Ocorreu um erro ao clonar este exercício. Por favor, tente de novo!');
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao clonar este exercício. Por favor, tente de novo!'], 200);
        }
        DB::commit();

        request()->session()->flash('success', 'O exercício "' . $exercise->title . '" foi clonado com sucesso!');
        return response()->json([
            'status' => 'success', 
            'message' => 'O exercício "' . $exercise->title . '" foi clonado com sucesso!',
            'clone_exercise_id' => $exercise_clone->id
        ], 200);
        
    }

    public function getExerciseMedias($exercise_id = null)
    {
        if(!$exercise_id){
            return 'no_medias';
        }

        $exercise = Exercise::find($exercise_id);
        $count = 0;
        $array = [];
        // dd($exercise, $exercise->medias()->count());

        if(!$exercise->medias()->count()){
            return 'no_medias';
        }
        // foreach ($exercise->medias()->get() as $media) {
        //     // dd($media);
        //     $path = 'webapp-macau-storage/exercises/'.$exercise_id.'/medias/'.$media->media_url;
        //     $media_file = new \Illuminate\Http\File($path);
        //     $array['media_'.$count] = 
        //     [
        //         'name' => $media_file->getFilename(),
        //         'size' => $media_file->getSize(),
        //         'path' => '/'.$media_file->getPathname()
        //     ];
        //     $count++;
        // }

        $path = 'webapp-macau-storage/exercises/'.$exercise_id.'/medias/'.$exercise->medias->media_url;
        $media_file = new \Illuminate\Http\File($path);
        $array = [
            'poster' => [
                'name' => $media_file->getFilename(),
                'size' => $media_file->getSize(),
                'path' => '/'.$media_file->getPathname(),
                'media_type' => explode('/', $media_file->getMimeType())[0]
            ]
        ];
        return $array;
    }

    public function getExercisePresentationImage($exercise_id = null)
    {
        if(!$exercise_id){
            return 'no_medias';
        }

        $exercise = Exercise::find($exercise_id);
        $count = 0;
        $array = [];
        // dd($exercise, $exercise->medias()->count());

        if(!$exercise->presentation_image){
            return 'no_medias';
        }

        $path = 'webapp-macau-storage/exercises/'.$exercise_id.'/presentation_image/'.$exercise->presentation_image;
        $media_file = new \Illuminate\Http\File($path);
        $array = [
            'poster' => [
                'name' => $media_file->getFilename(),
                'size' => $media_file->getSize(),
                'path' => '/'.$media_file->getPathname(),
                'media_type' => explode('/', $media_file->getMimeType())[0]
            ]
        ];
        return $array;
    }

    public function getAutoExercise()
    {
        $this->viewShareNotifications();

        return view('exercises.auto-exercise');
    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
