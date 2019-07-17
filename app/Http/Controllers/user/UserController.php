<?php

namespace App\Http\Controllers\user;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * [GET]
     * Get all users
     * TODO - add filters
     */
    function getList()
    {
        return User::all();
    }

    /**
     * [GET]
     * Get a user by ID
     * @param id - PK(users.id)
     */
    function get($id)
    {
        $user = User::find($id);
        return $this->successResponse($user);
    }

    /**
     * [POST]
     * Create a user
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
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
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->usertype = $validated['usertype'];

        try {

            $this->authorize('store', $user);
            $user->save();

            return $this->successCreateResponse($user->name);

        } catch(Exception $e) {

            $this->errorResponse($e->getMessage());

        }
    }

    /**
     * [PUT]
     * Updates a user by ID
     * @param id - user to be updated: PK(users.id)
     * 
     * @return json
     */
    public function update($id, Request $request)
    {

        try {

            $user = User::findOrFail($id);
            $this->validate($request, [
                'name' => 'required|max:100',
                'username' => "required|unique:users,username,$id|max:50",
                'email' => "required|unique:users,email,$id|max:255",
            ]);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->update();

            return $this->successUpdateResponse($user->name);

        } catch (Exception $e) {

            return $this->errorResponse($e->getMessage());

        }

    }

    /**
     * [DELETE]
     * Delete a user by ID
     * @param id - user to be deleted: PK(users.id)
     * 
     * @return json
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->successDeleteResponse($user->name);
    }

    /**
     * [GET]
     * Gets all the pages assigned to the user
     */
    function getPages($id)
    {
        $pages = User::find($id)->pages;
        return $this->successResponse($pages);
    }
}