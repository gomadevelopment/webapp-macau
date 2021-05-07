<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\User,
    App\StudentClass,
    App\Exame,
    App\ExerciseLevel,
    App\ExerciseCategory,
    App\QuestionType;

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
        if(auth()->user()->isStudent()){
            
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

        // Professor - All Student Exames
        $students = collect();
        $professor_all_classes = auth()->user()->classes;
        foreach($professor_all_classes as $class){
            foreach($class->students as $student){
                if($student->active){
                    $students->add($student);
                }
            }
        }

        $all_students_exames = self::getProfessorClassroomStudents($students, false, [], 10);

        $students_exames_awaiting_evaluation = $all_students_exames[0];
        $students_exames_in_course = $all_students_exames[1];
        $students_exames_evaluated = $all_students_exames[2];
                
        // Student - Student Exames
        $student_in_evaluation_exames = auth()->user()->isStudent() ? auth()->user()->getStudentInEvaluationExames(0, 4) : collect();
        $student_in_course_exames = auth()->user()->isStudent() ? auth()->user()->getStudentInCourseExames(0, 4) : collect();
        $student_done_exames = auth()->user()->isStudent() ? auth()->user()->getStudentDoneExames(0, 4) : collect();

        $unread_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_notifications = auth()->user()->getReadNotifications(10)->get();
        // dd($unread_notifications, $read_notifications);

        $inputs = [];

        if(auth()->user()->isStudent() || (auth()->user()->isProfessor() && !auth()->user()->isActive())){
            $levels = collect();
            $categories = collect();
            $question_types_subtypes = collect();
            $user_exercises = collect();
        }
        else{
            $levels = ExerciseLevel::get();
            $categories = ExerciseCategory::get();
            $question_types_subtypes = QuestionType::with('subtypes')->get();
            $filters = ['class_id' => 0]; // Means All Classes
            // dd(Exame::applyPerformanceFilters($filters));
            $user_exercises = Exame::applyPerformanceFilters($filters, 'by_class');
        }

        return view('classroom.index', compact(
            'students', 
            'students_exames_awaiting_evaluation',
            'students_exames_in_course',
            'students_exames_evaluated',
            'student_in_evaluation_exames',
            'student_in_course_exames',
            'student_done_exames',
            'students_colleagues', 
            'unread_notifications', 
            'read_notifications',
            'inputs', 
            'levels', 
            'categories', 
            'question_types_subtypes', 
            'user_exercises'
        ));
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

    // Professor Classroom
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

        if(isset($filters['page_to_change'])){

            $all_students_exames = self::getProfessorClassroomStudents($students, true, $filters, 10);

            $students_exames_awaiting_evaluation = $all_students_exames[0];
            $students_exames_in_course = $all_students_exames[1];
            $students_exames_evaluated = $all_students_exames[2];
                
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
                'page_changed' => true
            ]);
        }

        $all_students_exames = self::getProfessorClassroomStudents($students, false, [], 10);

        $students_exames_awaiting_evaluation = $all_students_exames[0];
        $students_exames_in_course = $all_students_exames[1];
        $students_exames_evaluated = $all_students_exames[2];

        $view = view()->make("classroom.classroom-partials.classroom_exercises_tabs_content", [
            'students' => $students,
            'students_exames_awaiting_evaluation' => $students_exames_awaiting_evaluation,
            'students_exames_in_course' => $students_exames_in_course,
            'students_exames_evaluated' => $students_exames_evaluated
        ]);
        $html = $view->render();

        $user_exercises = Exame::applyPerformanceFilters($filters, $filters['by_student_or_class']);
        
        return response()->json([
            'status' => 'success',
            'html' => $html,
            'page_changed' => false,
            'user_exercises' => $user_exercises
        ]);
    }

    public function getProfessorClassroomStudents($students, $has_pagination = false, $filters = [], $perPage = 10)
    {
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

        // Professor
        $students_exames_awaiting_evaluation = $this->custom_paginate($students_exames_awaiting_evaluation, 4, !$has_pagination ? null : $filters['page_awaiting_evaluation'], 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_awaiting_evaluation'
            ]);
        $students_exames_in_course = $this->custom_paginate($students_exames_in_course, 4, !$has_pagination ? null : $filters['page_in_course'], 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_in_course'
            ]);
        $students_exames_evaluated = $this->custom_paginate($students_exames_evaluated, 4, !$has_pagination ? null : $filters['page_evaluated'], 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page_evaluated'
            ]);

        return [
            $students_exames_awaiting_evaluation,
            $students_exames_in_course,
            $students_exames_evaluated
        ];
    }

    // Student Classroom
    public function getStudentExercises()
    {
        $filters = request()->all();

        $student_in_evaluation_exames = 
            Exame::where('student_id', auth()->user()->id)
                ->where('is_finished', 1)
                ->where('is_revised', 1)
                ->get();
        $student_in_evaluation_exames = $this->custom_paginate($student_in_evaluation_exames, 4, $filters['page_in_evaluation'], 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'in_evaluation'
            ]);

        $student_in_course_exames = 
            Exame::where('student_id', auth()->user()->id)
            ->where('is_finished', 0)
            ->where('is_revised', 0)
            ->get();
        $student_in_course_exames = $this->custom_paginate($student_in_course_exames, 4, $filters['page_in_course'], 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'in_course'
            ]);

        $student_done_exames = 
            Exame::where('student_id', auth()->user()->id)
                ->where('is_finished', 1)
                ->where('is_revised', 1)
                ->get();
        $student_done_exames = $this->custom_paginate($student_done_exames, 4, $filters['page_done'], 
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'done'
            ]);

        // dd($student_done_exames);

        if($filters['page_to_change'] == 'in_evaluation'){
            $view = view()->make("classroom.student-exercises-evaluation.in-evaluation", [
                'student_in_evaluation_exames' => $student_in_evaluation_exames,
            ]);
        }
        else if($filters['page_to_change'] == 'in_course'){
            $view = view()->make("classroom.student-exercises-evaluation.in-course", [
                'student_in_course_exames' => $student_in_course_exames,
            ]);
        }
        else if($filters['page_to_change'] == 'done'){
            $view = view()->make("classroom.student-exercises-evaluation.done", [
                'student_done_exames' => $student_done_exames
            ]);
        }

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
