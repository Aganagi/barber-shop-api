<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message'=>'Daxil etdiyiniz parol səhvdir'
            ], 401);
        }
        $remenber = $request->boolean('remember_me', false);

        $token = $user->createToken($user->name, [],$remenber ? now()->addYear() : null);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message'=>'Siz çıxış etdiniz'
        ];
    }
}
