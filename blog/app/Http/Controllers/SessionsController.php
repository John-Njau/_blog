<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
//        validate the request
        $attributes = request()->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6|max:255'
        ]);

//        attempt to authenticate and log in the user
        if (!auth()->attempt($attributes)) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Your provided credentials could not be verified.'
                ]);

        }

        session()->regenerate();

        return redirect('/')->with('success', 'Welcome Back!');

//        throw ValidationException::withMessages([
//            'email' => 'Your provided credentials could not be verified.'
//
//        ]);
    }

    public function destroy()
    {

//        dd('logout');
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }


}
