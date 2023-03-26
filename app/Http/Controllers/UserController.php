<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        return view('pages.user', [
            'users' => $users,
            'editUser' => null,
            'edit' => false,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];
        $user = User::create($data);
        $user->assignRole($request->input('role'));
        return redirect(url('/users'))->with('success', 'User Added Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::get();
        $editUser = User::find($id);
        return view('pages.user', [
            'users' => $users,
            'editUser' => $editUser,
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name
        ]);
        return redirect(url('/users'))->with('editsuccess', 'User Updated Successfully!');
    }
}
