<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(){

        $posts = Post::latest()->withTrashed()->paginate(6);

        $postsCount = Post::withTrashed()->count();

        $inDashBoard = true;

        $inAll = true;

        $inTrashed = false;

        $inPublished = false;

        return view('pages.dashBoard',compact(['posts','postsCount','inDashBoard','inTrashed','inPublished','inAll']));


    }

    public function trashedData(){

        $posts = Post::latest()->onlyTrashed()->paginate(6);

        $postsCount = Post::onlyTrashed()->count();

        $inDashBoard = true;

        $inTrashed = true;

        $inPublished = false;

        $inAll = false;


        return view('pages.dashBoard',compact(['posts','postsCount','inDashBoard','inTrashed','inPublished','inAll']));

    }

    public function publishedData()
    {
        $posts = Post::latest()->withoutTrashed()->paginate(6);

        $postsCount = Post::withoutTrashed()->count();

        $inDashBoard = true;
        $inTrashed = false;
        $inPublished = true;
        $inAll = false;

        return view(
            'pages.dashBoard',
            compact(
                'posts',
                'postsCount',
                'inDashBoard',
                'inTrashed',
                'inPublished'
                ,'inAll'
            )
        );
    }
}
