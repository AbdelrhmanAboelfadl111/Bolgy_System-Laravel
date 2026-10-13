<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    $posts = Post::latest()->paginate(6);
    $postsCount = Post::count();
    $inDashBoard = false;

    return view('pages.home', compact(['posts','postsCount','inDashBoard']));
}
}
