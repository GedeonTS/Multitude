<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
//impoort usersCoolPosts


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $posts = Post::all();
    // $posts = Post::where('user_id', auth()->user()->id)->get();
    $posts=[];
    if (auth()->check()){
        $posts = auth()->user()->usersCoolPosts ()->latest()->get();
    }
    return view('home',['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);


// blog post related tasks

Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);