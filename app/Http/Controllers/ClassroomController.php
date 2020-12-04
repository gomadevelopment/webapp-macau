<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class ClassroomController extends Controller
{
    public function index()
    {
        // User is student
        if(auth()->user()->user_role_id == 3){
            $colleagues = User::where('user_role_id', 3)->where('id', '!=', auth()->user()->id)->get();
        }
        // User is professor
        else{
            $colleagues = User::where('user_role_id', '!=', 3)->where('id', '!=', auth()->user()->id)->get();
        }

        // $colleagues = User::get();

        return view('classroom.index', compact('colleagues'));
    }
}
