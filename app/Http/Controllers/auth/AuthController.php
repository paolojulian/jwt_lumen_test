<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\User;

class AuthController extends Controller
{
     /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * POST - LOGIN FUNCTION
     * TODO - add salt
     * checks the username that matches the salt and hash password of the user
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:50',
            'password' => 'required',
        ]);

        try {
            if (! $token = $this->jwt->attempt($request->only('username', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'), 200);
    }

    public function checkToken () {
        return response()->json(['Can Access'], 200);
    }
}