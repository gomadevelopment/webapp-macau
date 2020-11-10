<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    public function index()
    {
        return view('exercises.index');
    }

    public function save($id = null)
    {
        return view('exercises.save');
    }

    public function savePost($id = null)
    {
        return view('exercises.save');
    }

    public function saveQuestion($id = null)
    {
        return view('exercises.questions.save');
    }

    public function savePostQuestion($id = null)
    {
        return view('exercises.questions.save');
    }

    public function performExercise($id = null)
    {
        return view('exercises.fill_exercises.perform');
    }

    public function performPostExercise($id = null)
    {
        return view('exercises.fill_exercises.perform');
    }
}
