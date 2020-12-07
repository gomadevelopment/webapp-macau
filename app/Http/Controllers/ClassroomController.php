<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;

use App\User,
    App\StudentClass;

class ClassroomController extends Controller
{
    public function index()
    {
        
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

        return view('classroom.index', compact('students_colleagues'));
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
}
