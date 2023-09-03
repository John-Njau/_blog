<?php

use App\Http\Controllers\PostCommentsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

//mailchimp test
Route::post('newsletter', function () {
    request()->validate(['email' => 'required|email']);

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us9'
    ]);

//    $response = $mailchimp->lists->getAllLists();
//    $response = $mailchimp->lists->getList('a27ced3b82');
//    $response = $mailchimp->lists->getListMembersInfo('a27ced3b82');
//    $response = $mailchimp->ping->getLandingPageStats('a27ced3b82');

    try {
        $response = $mailchimp->lists->addListMember('a27ced3b82', [
            'email_address' => request('email'),
            'status' => 'subscribed',
        ]);
    } catch (\Exception $e) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

//    add a new member to the list
//    $response = $mailchimp->lists->addListMember('a27ced3b82', [
//        'email_address' => request('email'),
//        'status' => 'subscribed',
//    ]);



//    dd($response);

    return redirect('/')
        ->with('success', 'You are now signed up for our newsletter!');


});

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);

//comments
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

//middleware for auth/guest
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

//Route::get('authors/{author:username}', function (User $author) {
//    return view('posts.index', [
//        'posts' => $author->posts,
//    ]);
//});
