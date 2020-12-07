<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\StudentClass,
    App\StudentClassUser,
    App\User;

class ClassesController extends Controller
{
    public function createClass()
    {
        $data = request()->only('class_name');
        $createClass = StudentClass::createClass($data['class_name']);

        if(!$createClass){
            // request()->session()->flash('error', 'O nome da turma que inseriu já existe. Por favor dê outro nome à turma.');
            return response()->json(['status' => 'error', 'message' => 'O nome da turma que inseriu já existe. Por favor dê outro nome à turma.'], 200);
        }

        $view = view()->make("users.edit-tab-contents.edit_classes", [
            'classes' => auth()->user()->classes,
            'students_without_class' => User::usersWithOutClass()
        ]);
        $html = $view->render();

        // request()->session()->flash('success', 'Turma criada com sucesso!');
        return response()->json([
            'status' => 'success',
            'message' => 'A turma '. $createClass->name .' foi criada com sucesso!',
            'html' => $html
        ]);
    }

    public function insertStudentsInClass()
    {
        $data = request()->all();
        
        $class = StudentClass::find($data['class_id']);
        if(!$class){
            // request()->session()->flash('error', 'A turma não foi encontrada. Por favor, tente de novo.');
            return response()->json(['status' => 'error', 'message' => 'A turma não foi encontrada. Por favor, tente de novo.'], 200);
        }

        $insertStudent = StudentClassUser::insertStudent($data);

        $view = view()->make("users.edit-tab-contents.classes.unique_class_partial", [
            'class' => $class
        ]);
        $html = $view->render();

        $view2 = view()->make("users.edit-tab-contents.classes.insert-student-modal", [
            'students_without_class' => User::usersWithOutClass()
        ]);
        $html2 = $view2->render();

        // request()->session()->flash('success', 'Alunos inseridos na turma ' . $class->name . ' com sucesso!');
        return response()->json([
            'status' => 'success',
            'message' => 'Os alunos seleccionados foram inseridos na turma '. $class->name .' com sucesso!',
            'html' => $html,
            'html2' => $html2
        ]);
    }

    public function removeStudentFromClass($student_id)
    {
        $student = User::find($student_id);
        
        if(!$student){
            return response()->json(['status' => 'error', 'message' => 'O aluno seleccionado não foi encontrado. Por favor, tente de novo.'], 200);
        }

        if(!$student->student_class_user){
            return response()->json(['status' => 'error', 'message' => 'O aluno seleccionado já não pertence a esta turma. Por favor, tente de novo.'], 200);
        }
        $class = $student->student_class_user->student_class;
        $student->student_class_user->delete();

        $view = view()->make("users.edit-tab-contents.classes.unique_class_partial", [
            'class' => $class
        ]);
        $html = $view->render();

        $view2 = view()->make("users.edit-tab-contents.classes.insert-student-modal", [
            'students_without_class' => User::usersWithOutClass()
        ]);
        $html2 = $view2->render();
        
        return response()->json([
            'status' => 'success',
            'message' => 'O aluno '. $student->username .' for removido da turma '. $class->name .' com sucesso!',
            'html' => $html,
            'html2' => $html2
        ]);
    }
}
