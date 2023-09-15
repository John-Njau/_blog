<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use Inertia\Inertia;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return Inertia::render('register/create');

    }

    public function store()
    {
        // validate the user input
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:3', 'max:55', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:255'],
        ]);

//        check the attributes
//        return request()->all();
//
//      persist the user
        $user = User::create($attributes);

        // assign role
        $role = Role::where('name', 'User')->first();
        $user->roles()->attach($role);

//fire register event
//  TODO:      send welcome email

        // sign the user in
        auth()->login($user);

//
//        // redirect
        return redirect('/')->with('success', 'Your account has been created.');

//        return redirect()->route('register.create')->with('success', 'Your account has been created.');
    }

    public function TestVueRegister()
    {
        return view('register.test');
    }

    public function registerUserEndpoint(Request $request)
    {
        // Validate the user input
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:3', 'max:55', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:255'],
        ]);

        // Persist the user
        $user = User::create($attributes);

        // Assign a default role (e.g., 'User')
        $role = Role::where('name', 'User')->first();
        $user->roles()->attach($role);

        // Sign the user in
        auth()->login($user);

        // Prepare the JSON response
//

        if ($user) {
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user,
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'User creation failed',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

//        dd($response);
    }
}

