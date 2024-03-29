<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(){
        // tokens showing error but working properly
        auth()->user()->tokens()->delete();

        return response()->json([
           'message' => 'Successfully logged out'
        ], 200);
    }

    public function login(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();


        if(!$user || Hash::check($request->password,$user->password)){
            return response([
                'error' => 'Invalid credentials'
            ],401);
        }
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
