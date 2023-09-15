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

        return view(
            'admin.users.index',
            ['users' => $users]
        );
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->roles;

        return view('admin.users.show', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        User::create($request->all());

        return back();
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.show', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {

        //        dd($request->all());

        $user->roles()->sync($request->role);

        return redirect("/admin/users")->with('success', 'User Role Updated!');

        //        if (!$request->roles) {
        //            $user->roles()->detach();
        //            return back();
        //        } else {
        //            $user->roles()->sync($request->roles);
        //            return redirect("/admin/users")->with('success', 'User Roles Updated!');
        //
        //        }
        //        $user->roles()->sync($request->roles);

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();

        return back();
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
