<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        $token = $user->createToken('MyApp')->accessToken;

        return response([
            'message' => "Register successfully",
            'token' => $token
        ], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('MyApp')->accessToken;

            return response([
                'message' => "Login succesfully",
                'token' => $token
            ], 200);
        } else {
            return response(['error' => 'Unauthorized'], 401);
        }
    }
}
