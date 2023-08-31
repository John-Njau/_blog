<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {

//       return request()->all();

        // validate the user input
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:3', 'max:55'],
            'email' => ['required', 'email', 'max:255', 'unique:users'], // unique:users is a rule
            'password' => ['required', 'min:6', 'max:255'],
        ]);

        dd("success", $attributes);
//
//        // persist the user
//        User::create($attributes);
//
//        // sign the user in
//        auth()->attempt($attributes);
//
//        // redirect
//        return redirect('/');
    }
}
