<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserForLogin;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public $successStatus = 200;
    public $unauthorizedStatus = 401;

    public function register(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    }

    public function login(Request $request){
        $this->validateLogin($request);
        if (!Auth::attempt( request(['email', 'password']) )) {
            return $this->unauthorized();
        }
        $user = Auth::user();
        $user['token'] =  $user->createToken('auth_token')->plainTextToken;
        $user['token_type'] =  'Bearer';

        $success = new UserForLogin($user);

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout( Request $request ) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' =>'session was closed']);
    }

    public function getUser() {

        return response()->json(['success' => Auth::user()], $this->successStatus);
    }

    public function unauthorized() { 
        return response()->json(['message' =>"unauthorized"], $this->unauthorizedStatus); 
    }
}
