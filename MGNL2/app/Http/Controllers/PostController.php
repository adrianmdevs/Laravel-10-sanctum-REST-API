<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post="Welcome to Murigu Gitonga's Newsletter";
        return view('posts.index',['post'=>$post]);
    }
}
