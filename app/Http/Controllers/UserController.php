<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('pages.user', [
            'users' => $users,
            'editUser' => null,
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            // TODO:: onek kaaj korte hobe eikhane
        ];
        User::create($data);
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
