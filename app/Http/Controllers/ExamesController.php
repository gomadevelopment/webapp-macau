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
    App\Inquiry,
    App\Exame;

use DB;

class ExamesController extends Controller
{
    public function __construct()
    {
        view()->share('topNavBarOption', 'exercises');
    }

    public function performExercise($exercise_id)
    {
        $this->viewShareNotifications();

        $exercise = Exercise::find($exercise_id);

        $exame_review = false;

        $exame_correction = false;

        DB::beginTransaction();
        try {
            if(auth()->user()->hasExerciseInProgress($exercise->id) == 'no_exame_started'){
                $exame = Exame::cloneStudentExame($exercise, auth()->user()->belongsToTeacherClass($exercise->user_id));
                if($exame->has_time){
                    $time_left = gmdate("H:i:s", $exame->time * 60);
                }
                else{
                    $time_left = '00:00:00';
                }
            }
            else if(auth()->user()->hasExerciseInProgress($exercise->id) == 'has_exame_finished'){
                $exame_review = true;
                $exame = Exame::where('student_id', auth()->user()->id)->where('exercise_id', $exercise->id)->first();
                $time_left = '00:00:00';
                // request()->session()->flash('error', 'Já terminou este exercício ou o mesmo já não está disponível! Escolha outro exercício!');
                // return redirect()->to('/exercicios');
            }
            else{
                $exame = auth()->user()->hasExerciseInProgress($exercise->id);
                if($exame->has_time){
                    $time_left = $exame->calculateExameTimeLeft();
                }
                else{
                    $time_left = '00:00:00';
                }
            }

        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            request()->session()->flash('error', 'Ocorreu um erro ao criar o seu exame. Por favor, tente de novo ou contacte o professor autor.');
            return redirect()
                    ->back();
        }
        DB::commit();


        $pre_listening_questions = $exame->questions()->where('section', 'Pré-Escuta')->get();
        $listening_questions = $exame->questions()->where('section', 'À Escuta')->get();
        $listening_shop_questions = $exame->questions()->where('section', 'Oficina da Escuta')->get();
        $after_listening_questions = $exame->questions()->where('section', 'Pós-Escuta')->get();

        $inquiries = Inquiry::orderBy('order', 'asc')->where('order', '!=', 999)->get();
        $anxiety_inquiry = Inquiry::where('order', 999)->first();

        return view(
            'exercises.fill_exercises.perform', 
            compact(
                'exercise',
                'exame',
                'time_left',
                'exame_review',
                'exame_correction',
                'pre_listening_questions', 
                'listening_questions', 
                'listening_shop_questions',
                'after_listening_questions',
                'inquiries',
                'anxiety_inquiry'));
    }

    public function performPostExercise($exercise_id)
    {
        $this->viewShareNotifications();

        $inputs = request()->all();

        $exercise = Exercise::find($exercise_id);
        $exame = Exame::find($inputs['exame_id']);
        $student = auth()->user();
        $has_questions = true;


        DB::beginTransaction();
        try {
            
            $student_exercise_submition_info = $exame->saveExerciseByStudent($exercise, $inputs);

            $score = $student_exercise_submition_info[0];
            $teacher_correction = $student_exercise_submition_info[1];

            if(isset($student_exercise_submition_info[3]) && $student_exercise_submition_info[3] == 'no_questions'){
                $has_questions = false;
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'conclusion_time' => date('d/m/Y'),
                'message' => 'Ocorreu um erro ao guardar o seu exame. Por favor, contacte o professor autor.'
            ]);
        }
        DB::commit();

        return response()->json([
            'status' => 'success',
            'score' => $score,
            'teacher_correction' => $teacher_correction,
            'conclusion_time' => date('d/m/Y'),
            'has_questions' => $has_questions
        ]);
    }

    public function updatePauseTimers($exame_id)
    {
        $inputs = request()->only('to_update', 'to_update_timestamp');

        $exame = Exame::find($exame_id);

        if($inputs['to_update'] == 'pause_start'){
            if(!$exame->pause_start_timestamp){
                $exame->pause_start_timestamp = $inputs['to_update_timestamp'];
            }
        }
        else if($inputs['to_update'] == 'pause_end'){
            if($exame->pause_start_timestamp){
                $exame->pause_end_timestamp = $inputs['to_update_timestamp'];
            }
        }
        $exame->save();
    }

    public function profCorrectionExameGet($exame_id, $student_id)
    {
        $this->viewShareNotifications();

        $exame = Exame::find($exame_id);

        $student = User::find($student_id);

        if(!$exame || !$student){
            request()->session()->flash('error', 'Exame ou Aluno não encontrado. Por favor, atualize a página e tente de novo.');
            return redirect()
                    ->back();
        }

        if($exame->student->id != $student_id){
            request()->session()->flash('error', 'Este Exame não pertence a este Aluno. Por favor, atualize a página e tente de novo.');
            return redirect()
                    ->back();
        }

        $exercise = $exame->exercise;

        $time_left = '00:00:00';

        $exame_review = true;

        $exame_correction = true;

        $pre_listening_questions = $exame->questions()->where('section', 'Pré-Escuta')->get();
        $listening_questions = $exame->questions()->where('section', 'À Escuta')->get();
        $listening_shop_questions = $exame->questions()->where('section', 'Oficina da Escuta')->get();
        $after_listening_questions = $exame->questions()->where('section', 'Pós-Escuta')->get();

        $inquiries = Inquiry::orderBy('order', 'asc')->where('order', '!=', 999)->get();
        $anxiety_inquiry = Inquiry::where('order', 999)->first();

        return view(
            'exercises.fill_exercises.perform', 
            compact(
                'exercise',
                'exame',
                'time_left',
                'exame_review',
                'exame_correction',
                'pre_listening_questions', 
                'listening_questions', 
                'listening_shop_questions',
                'after_listening_questions',
                'inquiries',
                'anxiety_inquiry'));
    }

    public function profCorrectionExamePost($exame_id, $student_id)
    {
        $this->viewShareNotifications();

        $inputs = request()->all();

        $exame = Exame::find($exame_id);

        $student = User::find($student_id);

        if(!$exame || !$student){
            request()->session()->flash('error', 'Exame ou Aluno não encontrado. Por favor, atualize a página e tente de novo.');
            return redirect()
                    ->back();
        }

        DB::beginTransaction();
        try {
            $exame->professorExameCorrection($inputs);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao guardar a correção deste exame. Por favor, atualize a página e tente de novo.'
            ]);
        }
        DB::commit();

        request()->session()->flash('success', 'Exame corrigido com sucesso!');
        return response()->json([
                'status' => 'success',
                'message' => 'Exame corrigido com sucesso!'
            ]);
    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
