<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/dashboard', [DashBoardController::class,'index'])->name('dashBoard');

Route::get('/dashBoard/trashed', [DashBoardController::class,'trashedData'])->name('trashedData');

Route::get('/dashBoard/published', [DashBoardController::class,'publishedData'])->name('publishedData');


Route::prefix("/post")->name("post.")->group(function(){

    Route::get('/add', [PostController::class,'addPost'])->name('add');
    Route::post('/add', [PostController::class,'submitAddPost'])->name('submitAdd');
    Route::get('/{id}/delete', [PostController::class,'deletePost'])->name('delete');
    Route::get('/{id}/restore', [PostController::class,'restorePost'])->name('restore');
    Route::get('/{id}/forceDelete', [PostController::class,'forceDelete'])->name('forceDelete');
    Route::get('/{id}/{author_name}/{created_at}/edit', [PostController::class,'editPost'])->name('edit');
    Route::post('/{id}/edit', [PostController::class,'submitEditPost'])->name('submitEdit');

});
