<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\User,
    App\StudentClass;

class ClassroomController extends Controller
{
    public function __construct()
    {
        view()->share('topNavBarOption', 'classroom');
    }

    public function index()
    {
        $this->viewShareNotifications();
        // User is student
        if(auth()->user()->user_role_id == 3){
            
            if(!auth()->user()->student_class_user){
                $students_colleagues = collect([]);
            }
            else{
                $class = auth()->user()->student_class_user->student_class;
                $students_colleagues = auth()->user()->getStudentColleagues($class->id);
            }
        }
        // User is professor
        else{
            $students_colleagues = auth()->user()->getProfessorStudents();
        }

        // All Student Exames
        $students = collect();
        $professor_all_classes = auth()->user()->classes;
        foreach($professor_all_classes as $class){
            foreach($class->students as $student){
                $students->add($student);
            }
        }

        $students_exames_awaiting_evaluation = collect();
        $students_exames_in_course = collect();
        $students_exames_evaluated = collect();
        foreach($students as $student){
            $student['exames_awaiting_evaluation'] = collect();
            $student['exames_in_course'] = collect();
            $student['exames_evaluated'] = collect();
            foreach($student->student_exames as $exame){
                if($exame->is_finished && $exame->is_revised){
                    $student['exames_evaluated']->add($exame);
                    $students_exames_evaluated->add($student);
                }
                else if($exame->is_finished && !$exame->is_revised){
                    $student['exames_awaiting_evaluation']->add($exame);
                    $students_exames_awaiting_evaluation->add($student);
                }
                else if(!$exame->is_finished){
                    $student['exames_in_course']->add($exame);
                    $students_exames_in_course->add($student);
                }
            }
        }

        $students_exames_awaiting_evaluation = $students_exames_awaiting_evaluation->unique();
        $students_exames_in_course = $students_exames_in_course->unique();
        $students_exames_evaluated = $students_exames_evaluated->unique();

        $students_exames_awaiting_evaluation = $this->custom_paginate($students_exames_awaiting_evaluation, 2, null, 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_awaiting_evaluation'
            ]);
        $students_exames_in_course = $this->custom_paginate($students_exames_in_course, 2, null, 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_in_course'
            ]);
        $students_exames_evaluated = $this->custom_paginate($students_exames_evaluated, 2, null, 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_evaluated'
            ]);

        $unread_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_notifications = auth()->user()->getReadNotifications(10)->get();
        // dd($unread_notifications, $read_notifications);

        return view('classroom.index', compact(
            'students', 
            'students_exames_awaiting_evaluation',
            'students_exames_in_course',
            'students_exames_evaluated',
            'students_colleagues', 
            'unread_notifications', 
            'read_notifications'));
    }

    public function custom_paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function studentsClassSelect($class_id)
    {
        if($class_id){
            $class = StudentClass::find($class_id);
            
            if(!$class){
                return response()->json(['status' => 'error', 'message' => 'A turma seleccionada não foi encontrada. Por favor, tente de novo.'], 200);
            }

            $students_colleagues = auth()->user()->getProfessorStudents($class->id);
        }
        else{
            $students_colleagues = auth()->user()->getProfessorStudents();
        }

        $view = view()->make("classroom.classroom-partials.students-colleagues-partial", [
            'students_colleagues' => $students_colleagues
        ]);
        $html = $view->render();
        
        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

    public function getStudentExercisesByClass($class_id)
    {
        $filters = request()->all();
        // dd($filters);
        if($class_id == 0){
            $students = collect();
            $professor_all_classes = auth()->user()->classes;
            foreach($professor_all_classes as $class){
                foreach($class->students as $student){
                    $students->add($student);
                }
            }
        }
        else{
            $class = StudentClass::find($class_id);
            if(!$class){
                return response()->json(['status' => 'error', 'message' => 'A turma seleccionada não foi encontrada. Por favor, atualize a página e tente de novo.'], 200);
            }
            $students = $class->students;
        }

        // All Student Exames - Class Change
        $students_exames_awaiting_evaluation = collect();
        $students_exames_in_course = collect();
        $students_exames_evaluated = collect();
        foreach($students as $student){
            $student['exames_awaiting_evaluation'] = collect();
            $student['exames_in_course'] = collect();
            $student['exames_evaluated'] = collect();
            foreach($student->student_exames as $exame){
                if($exame->is_finished && $exame->is_revised){
                    $student['exames_evaluated']->add($exame);
                    $students_exames_evaluated->add($student);
                }
                else if($exame->is_finished && !$exame->is_revised){
                    $student['exames_awaiting_evaluation']->add($exame);
                    $students_exames_awaiting_evaluation->add($student);
                }
                else if(!$exame->is_finished){
                    $student['exames_in_course']->add($exame);
                    $students_exames_in_course->add($student);
                }
            }
        }

        $students_exames_awaiting_evaluation = $students_exames_awaiting_evaluation->unique();
        $students_exames_in_course = $students_exames_in_course->unique();
        $students_exames_evaluated = $students_exames_evaluated->unique();

        if(isset($filters['page_to_change'])){

            $students_exames_awaiting_evaluation = $this->custom_paginate($students_exames_awaiting_evaluation, 2, $filters['page_awaiting_evaluation'], 
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page_awaiting_evaluation'
                ]);
            $students_exames_in_course = $this->custom_paginate($students_exames_in_course, 2, $filters['page_in_course'], 
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page_in_course'
                ]);
            $students_exames_evaluated = $this->custom_paginate($students_exames_evaluated, 2, $filters['page_evaluated'], 
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page_evaluated'
                ]);
                
            if($filters['page_to_change'] == 'page_awaiting_evaluation'){
                $view = view()->make("classroom.professor-exercises-evaluation.awaiting-evaluation", [
                    'students_exames_awaiting_evaluation' => $students_exames_awaiting_evaluation,
                ]);
            }
            else if($filters['page_to_change'] == 'page_in_course'){
                $view = view()->make("classroom.professor-exercises-evaluation.in-course", [
                    'students_exames_in_course' => $students_exames_in_course,
                ]);
            }
            else if($filters['page_to_change'] == 'page_evaluated'){
                $view = view()->make("classroom.professor-exercises-evaluation.evaluated", [
                    'students_exames_evaluated' => $students_exames_evaluated
                ]);
            }

            $html = $view->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ]);
        }

        $students_exames_awaiting_evaluation = $this->custom_paginate($students_exames_awaiting_evaluation, 2, null, 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_awaiting_evaluation'
            ]);
        $students_exames_in_course = $this->custom_paginate($students_exames_in_course, 2, null, 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_in_course'
            ]);
        $students_exames_evaluated = $this->custom_paginate($students_exames_evaluated, 2, null, 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_evaluated'
            ]);

        $view = view()->make("classroom.classroom-partials.classroom_exercises_tabs_content", [
            'students' => $students,
            'students_exames_awaiting_evaluation' => $students_exames_awaiting_evaluation,
            'students_exames_in_course' => $students_exames_in_course,
            'students_exames_evaluated' => $students_exames_evaluated
        ]);
        $html = $view->render();
        
        return response()->json([
            'status' => 'success',
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
