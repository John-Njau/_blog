<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->get();

        return Inertia::render('admin/users/index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->roles;

        return Inertia::render('admin/users/show', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->back();
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return Inertia::render('admin/users/edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {


        $user->roles()->sync($request->role);

        return redirect()->route('admin.users.index')
            ->with('success', 'User Role Updated!');


    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();

        return redirect()->back();
    }

    //    api
    public function getUsers()
    {
        $users = User::with('roles')->get();
        return response()->json($users);
    }

    public function getSingleUser($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json($user);
    }

    // testing inertia vue
    public function testShow(User $user): Response
    {
        // the view is in resources/js/pages/Inertia.vue
        return Inertia::render('Inertia', [
            'user' => $user
        ]);
    }
}
