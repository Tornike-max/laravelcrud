<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersPosts()->get();
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('login');


//blogposts

Route::post('/create-post', [PostController::class, 'createPost'])->name('creteaPost');
Route::get('/edit-post/{post}', [PostController::class, 'editpost'])->name('editpost');
Route::put('/edit-post/{post}', [PostController::class, 'editActualPost'])->name('editActualPost');
Route::delete('/delete-post/{post}', [PostController::class, 'deletepost'])->name('deletepost');
