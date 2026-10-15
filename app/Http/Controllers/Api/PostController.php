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
            abort(404,"Post Not Found");
        }
        return $post;
    }

    public function getAllWithoutTrashed() {
        $posts = Post::latest()->paginate(6);
        $postsCountNumber =Post::latest()->get();
        $postsCount =$postsCountNumber->count();
        return response()->json([
            'posts' => $posts->items(),
            'postsCount' => $postsCount,
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'perPage' => $posts->perPage(),
            'nextPageUrl' => $posts->nextPageUrl(),
            'prevPageUrl' => $posts->previousPageUrl(),
        ]);
    }

    public function getAllWithTrashed() {
        $posts = Post::withTrashed()->latest()->paginate(6);
        $postsCountNumber =Post::withTrashed()->latest()->get();
        $postsCount =$postsCountNumber->count();
        return response()->json([
            'posts' => $posts->items(),
            'postsCount' => $postsCount,
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'perPage' => $posts->perPage(),
            'nextPageUrl' => $posts->nextPageUrl(),
            'prevPageUrl' => $posts->previousPageUrl(),
        ]);
    }

    public function getAllOnlyTrashed() {
        $posts = Post::onlyTrashed()->latest()->paginate(6);
        $postsCountNumber =Post::onlyTrashed()->withTrashed()->latest()->get();
        $postsCount =$postsCountNumber->count();
        return response()->json([
            'posts' => $posts->items(),
            'postsCount' => $postsCount,
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'perPage' => $posts->perPage(),
            'nextPageUrl' => $posts->nextPageUrl(),
            'prevPageUrl' => $posts->previousPageUrl(),
        ]);
    }

    public function submitAddPost(Request $request){
        $inDashBoard = true;

        $validate = $request->validate([
                'Title' => [
                    'required',
                    'string',
                    'min:3',
                    'max:150',
                ],

                'author_name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                ],

                'description' => [
                    'required',
                    'string',
                    'min:10',
                    'max:5000',
                ],
            ], [
                'Title.required' => 'Post title is required.',
                'Title.string' => 'Post title must be text.',
                'Title.min' => 'Post title must contain at least 3 characters.',
                'Title.max' => 'Post title cannot exceed 150 characters.',

                'author_name.required' => 'Author name is required.',
                'author_name.string' => 'Author name must be text.',
                'author_name.min' => 'Author name must contain at least 3 characters.',
                'author_name.max' => 'Author name cannot exceed 100 characters.',

                'description.required' => 'Post description is required.',
                'description.string' => 'Post description must be text.',
                'description.min' => 'Post description must contain at least 10 characters.',
                'description.max' => 'Post description cannot exceed 5000 characters.',
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

    public function getPostEdit(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'min:1'],
        ]);

        $post = $this->findPost((string) $validated['id']);

        return response()->json($post);
    }

    public function submitEditPost(Request $request,string $id){
        $inDashBoard = true;

        $post =  $this->findPost($id);


        $validate = $request->validate([
                'Title' => [
                    'required',
                    'string',
                    'min:3',
                    'max:150',
                ],

                'author_name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                ],

                'description' => [
                    'required',
                    'string',
                    'min:10',
                    'max:5000',
                ],
            ], [
                'Title.required' => 'Post title is required.',
                'Title.string' => 'Post title must be text.',
                'Title.min' => 'Post title must contain at least 3 characters.',
                'Title.max' => 'Post title cannot exceed 150 characters.',

                'author_name.required' => 'Author name is required.',
                'author_name.string' => 'Author name must be text.',
                'author_name.min' => 'Author name must contain at least 3 characters.',
                'author_name.max' => 'Author name cannot exceed 100 characters.',

                'description.required' => 'Post description is required.',
                'description.string' => 'Post description must be text.',
                'description.min' => 'Post description must contain at least 10 characters.',
                'description.max' => 'Post description cannot exceed 5000 characters.',
        ]);

        $post->update([
            'title' => $validate['Title'],
            'author_name' => $validate['author_name'],
            'body' => $validate['description'],
        ]);

        return response()->json('Post Has Been Successfully Edited');
    }
}
