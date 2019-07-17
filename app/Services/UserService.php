<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserService {
    public function handleCreateUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:50',
            'email' => 'required|email|max:255',
            'usertype' => [
                'required',
                Rule::in([1, 2, 3])
            ],
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->usertype = $request->usertype;
        $user->save();
        $this->authorize('store', $user);
        $user->save();
        return $user;
    }
}