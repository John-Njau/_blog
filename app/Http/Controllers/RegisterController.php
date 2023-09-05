<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
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
        $user->assignRole($role);
//fire register event
//  TODO:      send welcome email

        // sign the user in
        auth()->login($user);

//
//        // redirect
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
