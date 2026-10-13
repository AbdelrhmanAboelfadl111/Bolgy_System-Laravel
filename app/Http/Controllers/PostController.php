<?php

namespace App\Http\Controllers;

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

    public function addPost(){
        $inDashBoard = true;
        return view("pages.addPost",compact(['inDashBoard']));
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

        return redirect()->route("home")->with('success','Post Has Been Successfully Added');
    }

    public function deletePost(Request $request,string $id){
        $inDashBoard = true;
        $post =  $this->findPost($id);
        $post->delete();
        return redirect()->route("dashBoard")->with('success','Post Has Been Successfully Deleted');
    }

    public function restorePost(Request $request,string $id){
        $inDashBoard = true;
        $post =  $this->findPost($id,true);
        $post->restore();
        return redirect()->route("dashBoard")->with('success','Post Has Been Successfully Restored');
    }

    public function forceDelete(Request $request,string $id){
        $inDashBoard = true;
        $post =  $this->findPost($id,true);
        $post->forceDelete();
        return redirect()->route("dashBoard")->with('success','Post Has Been Successfully Restored');
    }

    public function editPost(string $id,string $author_name,string $created_at){
        $inDashBoard = true;
        $post =  $this->findPost($id);

        return view("pages.editPost",compact(['inDashBoard','id','author_name','created_at','post']));
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

        return redirect()->route("home")->with('success','Post Has Been Successfully Added');
    }
}
