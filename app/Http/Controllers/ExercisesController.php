<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    public function index()
    {
        return view('exercises.index');
    }
}
