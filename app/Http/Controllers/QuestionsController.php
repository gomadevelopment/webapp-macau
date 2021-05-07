<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exercise,
    App\Question,
    App\QuestionType;

use Illuminate\Support\Facades\Storage;
use DB;

use Illuminate\Validation\Rule;

class QuestionsController extends Controller
{
    public function __construct()
    {
        view()->share('topNavBarOption', 'exercises');
    }

    public function saveQuestion($exercise_id, $question_id = null)
    {
        $this->viewShareNotifications();

        $inputs = request()->all();

        $exercise = Exercise::find($exercise_id);

        $my_question_models = Question::my_models();

        if(isset($inputs['model_question_id'])){
            $question = Question::find($inputs['model_question_id']);
            $exercise_question_section = $inputs['exercise_question_section'];

            return response()->json([
                'status' => 'success',
                'url' => '/exercicios/'.$exercise_id.'/questao/modelo/'.$question->id.'/criar?exercise_question_section='.$exercise_question_section
            ]);
        }
        else{
            $question = $question_id ? Question::find($question_id) : null;
            $exercise_question_section = $question_id ? $question->section : $inputs['exercise_question_section'];
        }

        $question_types = QuestionType::get();

        $model_question_id = "false";

        return view('exercises.questions.save', compact('exercise', 'question', 'question_types', 'exercise_question_section', 'my_question_models', 'model_question_id'));
    }

    public function loadSaveQuestionModel($exercise_id, $question_id)
    {
        $this->viewShareNotifications();

        $inputs = request()->all();

        $exercise = Exercise::find($exercise_id);

        $my_question_models = Question::my_models();

        $question = Question::find($question_id);
        $exercise_question_section = $inputs['exercise_question_section'];

        $question_types = QuestionType::get();

        $model_question_id = "true";

        return view('exercises.questions.save', compact('exercise', 'question', 'question_types', 'exercise_question_section', 'my_question_models', 'model_question_id'));
    }

    public function savePostQuestion($exercise_id, $question_id = null)
    {
        $this->viewShareNotifications();

        $inputs = request()->all();

        // dd($inputs);

        $rules = [];

        if($question_id){
            if($inputs['question_reference']){
                $rules = Question::rulesForEdit([
                    'question_reference' => [Rule::unique('questions', 'reference')->ignore($question_id)]
                ]);
            }
            else{
                $rules = Question::rulesForEdit();
            }
        }
        else{
            if($inputs['question_reference']){
                $rules = Question::rulesForAdd([
                    'question_reference' => 'unique:questions'
                ]);
            }
            else{
                $rules = Question::rulesForAdd();
            }
        }

        $validator = \Validator::make($inputs, $rules, Question::$messages);

        // dd($validator);
        if ($validator->fails()) {
            request()->session()->flash('error', 'Ocorreu um erro ao criar/editar a questão. Por favor, tente de novo!');
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Ocorreu um erro ao criar/editar a questão. Por favor, verifique os erros no formulário.'
            ]);
        }
        // dd($inputs);
        DB::beginTransaction();
        try {

            $exercise = Exercise::find($exercise_id);

            $question = $question_id ? Question::find($question_id) : new Question();

            $question->switchQuestionType($exercise, $inputs);

        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);
            request()->session()->flash('error', 'Ocorreu um erro ao criar/editar a questão. Por favor, tente de novo!');
            dd($e);
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao criar/editar a questão. Por favor, verifique os erros no formulário.'
            ]);
        }

        DB::commit();

        request()->session()->flash('success', 'Questão criada/atualizada com sucesso!');

        return response()->json([
            'status' => 'success',
            'url' => '/exercicios/editar/'.$exercise->id,
            'ex_id' => $exercise->id
        ]);
    }

    public function deleteQuestion($exercise_id, $question_id)
    {
        // Delete Question
        $exercise = Exercise::find($exercise_id);
        $question = Question::find($question_id);

        if (!$exercise) {
            return response()->json(['status' => 'error', 'message' => 'Não foi possível encontrar este exercício. Por favor, tente de novo!'], 200);
        }
        if (!$question) {
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao apagar esta questão. Por favor, tente de novo!'], 200);
        }

        DB::beginTransaction();
        try{
            foreach($question->question_items as $question_item){
                if($question_item->question_item_media){
                    $question_item->question_item_media->delete();
                }
                $question_item->delete();
                Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$question_item->id.'/question_item');
            }
            $question->delete();
        }catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao apagar esta questão. Por favor, tente de novo!'], 200);
        }
        DB::commit();

        // $exercises->withPath('/exercicios');

        $view = view()->make("exercises.tab-contents.save_structure", [
            'exercise' => $exercise
        ]);
        $html = $view->render();

        $has_questions = $exercise->questions()->count() ? true : false;

        return response()->json([
            'status' => 'success',
            'has_questions' => $has_questions,
            'message' => 'Questão removida com sucesso!',
            'html' => $html,
        ]);
    }

    public function getQuestionsMenuList()
    {
        view()->share('topNavBarOption', 'questions');
        $this->viewShareNotifications();

        $inputs = request()->all();

        $empty_inputs = false;

        if(empty($inputs)){
            $inputs['page'] = 1;
            $empty_inputs = true;
        }

        $questions = Question::myModelsWithFilters($inputs);
        $exercises = Question::exercisesWithQuestionsWithReference();

        if($empty_inputs){
            return view('questions.questions_list', compact('questions', 'exercises', 'inputs'));
        }

        $view = view()->make("questions.list_partial", [
            'questions' => $questions,
            'exercises' => $exercises,
            'inputs' => $inputs
        ]);
        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'message' => 'Filtros Aplicados!',
            'html' => $html,
        ]);

    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
