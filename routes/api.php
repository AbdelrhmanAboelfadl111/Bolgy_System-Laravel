<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/post/getAllWithoutTrashed', [PostController::class, 'getAllWithoutTrashed']);

Route::get('/post/getAllWithTrashed', [PostController::class, 'getAllWithTrashed']);

Route::get('/post/getAllOnlyTrashed', [PostController::class, 'getAllOnlyTrashed']);


Route::post('/post/addPost', [PostController::class, 'submitAddPost']);

Route::post('/post/getPostEdit', [PostController::class, 'getPostEdit']);

Route::put('/post/editPost/{id}', [PostController::class, 'submitEditPost']);

Route::delete('/post/deletePost/{id}', [PostController::class, 'deletePost']);

Route::patch('/post/restorePost/{id}', [PostController::class, 'restorePost']);

Route::delete('/post/forceDelete/{id}', [PostController::class, 'forceDelete']);
