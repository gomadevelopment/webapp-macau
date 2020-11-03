<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }

    public function details($id = null)
    {
        return view('articles.details');
    }

    public function save($id = null)
    {
        return view('articles.save');
    }

    public function savePost($id = null)
    {
        return view('articles.save');
    }
}
