<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//    $response = $mailchimp->lists->getAllLists();
//    $response = $mailchimp->lists->getList('a27ced3b82');
//    $response = $mailchimp->lists->getListMembersInfo('a27ced3b82');
//    $response = $mailchimp->ping->getLandingPageStats('a27ced3b82');


//    add a new member to the list
//    $response = $mailchimp->lists->addListMember('a27ced3b82', [
//        'email_address' => request('email'),
//        'status' => 'subscribed',
//    ]);


//    dd($response);


//});

// posts
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// products


//comments
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

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
//    Route::get('admin/posts', [AdminPostController::class, 'index']);
//    Route::get('admin/posts/create', [AdminPostController::class, 'create']);
//    Route::post('admin/posts', [AdminPostController::class, 'store']);
//    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
//    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
//    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
});


// user management admin panel
//Route::get('admin/users', [AdminUserController::class, 'index'])->middleware('can:admin');
//Route::get('admin/users/{user}', [AdminUserController::class, 'show'])->middleware('can:admin');


Route::get('admin/users', [UserController::class, 'index'])->middleware('can:admin');
Route::get('admin/users/create', [UserController::class, 'create'])->middleware('can:admin');
Route::post('admin/users', [UserController::class, 'store'])->middleware('can:admin');
Route::put('admin/users/{user}', [UserController::class, 'update'])->middleware('can:admin');
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->middleware('can:admin');
Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin');

//Route::get('authors/{author:username}', function (User $author) {
//    return view('posts.index', [
//        'posts' => $author->posts,
//    ]);
//});
