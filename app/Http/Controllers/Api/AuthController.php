<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'name' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'messages' => $validate->errors()
            ]);
        }

        // User Management
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Token Management
        $token = $newUser->createToken('secret')->plainTextToken;

        return response()->json([
            'name' => $newUser->name,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function login(Request $request){
        if(! Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'messages' => 'Unauthorization'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('secret')->plainTextToken;

        return response()->json([
            'nama' => $user->name,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
