<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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

        // Return user data after successful login
//        return response()->json([
//            'message' => 'Welcome Back!',
//            'user' => auth()->user(),
//        ]);

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

//        return response()->json(['message' => 'Goodbye!']);

        return redirect('/')->with('success', 'Goodbye!');
    }

//    apis
    public function loginUserEndpoint()
    {
        // validate the request
        $attributes = request()->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6|max:255'
        ]);

        // attempt to authenticate and log in the user
        if (!auth()->attempt($attributes)) {
            return response()->json(['success' => false, 'message' => 'Your provided credentials could not be verified.'], 401);
        }

        session()->regenerate();

//        dd(auth()->user());

        // Return user data after successful login
        return response()->json([
            'message' => 'Welcome Back!',
            'user' => auth()->user(),
        ], Response::HTTP_OK);
    }





    public function logoutUserEndpoint()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Goodbye!',
        ], Response::HTTP_OK);
    }

}
