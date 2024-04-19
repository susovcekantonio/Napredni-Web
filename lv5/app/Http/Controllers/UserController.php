<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function getUsers()
    {
        $users = User::query()->orderBy('id', 'asc')->get();
        return response()->json($users);
    }

    public function changeRole(User $user, Request $request)
    {
        $user->role = $request->input('role');
        $user->save();
        return redirect()->back()->with('success', 'Successfully changed role.');
    }
}
