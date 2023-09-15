<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController
{
    public function __invoke()
    {
        return Inertia::render('newsletter/subscription');
    }

    public function subscribe(Newsletter $newsletter)
    {

//        dd($newsletter);

        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }
}
