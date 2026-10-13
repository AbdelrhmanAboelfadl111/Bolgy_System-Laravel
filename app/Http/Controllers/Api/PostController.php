<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private function findPost(string $id, bool $isTrashed = false){
        $post = $isTrashed ? Post::withTrashed()->find($id) : Post::find($id);
        if($post == null){
            abort(404);
        }
        return $post;
    }

    public function getAll() {
        $posts = Post::get();
        return response()->json($posts);
    }

    public function submitAddPost(Request $request){
        $inDashBoard = true;

        $validate = $request->validate([
            'Title' =>'required|string',
            'author_name' =>'required|string',
            'description' =>"required|string",
        ]);

        $posts = Post::create([
            "title" => $request->Title,
            "author_name" => $request->author_name,
            "body" => $request->description
        ]);

        return response()->json('Post Has Been Successfully Added');
    }

    public function deletePost(Request $request,string $id){
        $inDashBoard = true;
        $post =  $this->findPost($id);
        $post->delete();
        return response()->json('Post Has Been Successfully Deleted');
    }

    public function restorePost(Request $request,string $id){
        $inDashBoard = true;
        $post =  $this->findPost($id,true);
        $post->restore();
        return response()->json('Post Has Been Successfully Restored');
    }

    public function forceDelete(Request $request,string $id){
        $inDashBoard = true;
        $post =  $this->findPost($id,true);
        $post->forceDelete();
        return response()->json('Post Has Been Successfully Force Deleted');
    }

    public function submitEditPost(Request $request,string $id){
        $inDashBoard = true;

        $post =  $this->findPost($id);


        $validate = $request->validate([
            'Title' =>'required|string',
            'author_name' =>'required|string',
            'description' =>"required|string",
        ]);

        $post->update([
            'title' => $validate['Title'],
            'author_name' => $validate['author_name'],
            'body' => $validate['description'],
        ]);

        return response()->json('Post Has Been Successfully Edited');
    }
}
