<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// posts
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//comments
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);
Route::get('posts/{post:slug}/comments', [PostCommentsController::class, 'index']);

//middleware for auth/guest
//register
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

//login
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

//logout
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

//mailchimp test
Route::post('newsletter', NewsletterController::class);

//Admin
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});


// user management admin panel
Route::get('admin/users', [UserController::class, 'index'])->middleware('can:admin');
Route::put('admin/users/{user}', [UserController::class, 'update'])->middleware('can:admin');
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->middleware('can:admin');
Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin');

