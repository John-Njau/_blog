<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//registration
Route::post('register', [RegisterController::class, 'registerUserEndpoint']);

// Login routes
Route::post('login', [SessionsController::class, 'loginUserEndpoint'])->name('login');
Route::post('logout', [SessionsController::class, 'logoutUserEndpoint']);

//users
Route::get('users', [UserController::class, 'getUsers']);
Route::get('users/{user:id}', [UserController::class, 'getSingleUser']);

// API route for newsletter subscription
Route::post('newsletter', NewsletterController::class);

// posts
Route::get('posts', [PostController::class, 'allPosts']);
Route::get('posts/{post:slug}', [PostController::class, 'showSinglePost']);


//post comments
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'createPostComment']);
Route::get('posts/{post:slug}/comments', [PostCommentsController::class, 'getPostComments']);


// API routes for admin actions
//Route::middleware('can:admin')->group(function () {
//    // Admin Post Resource API
//    Route::apiResource('admin/posts', AdminPostController::class)->except('show');
//
//    // API route for user management
//    Route::get('admin/users', [UserController::class, 'index']);
//    Route::put('admin/users/{user}', [UserController::class, 'update']);
//    Route::delete('admin/users/{user}', [UserController::class, 'destroy']);
//    Route::get('admin/users/{user}/edit', [UserController::class, 'edit']);
//});
