<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        try {
            
            $user=User::create([
                'firstname'=>$registerRequest->input('firstname'),
                'lastname'=>$registerRequest->input('lastname'),
                'passportNum'=>$registerRequest->input('passportNum'),
                'username'=>$registerRequest->input('username'),
                'email'=>$registerRequest->input('email'),
                'password'=>Hash::make($registerRequest->input('password')),

            ]);

            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([ 'user' => $user, 'token' => $token ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }     
    }

    public function login(LoginRequest $loginRequest)
    {
        try {
            $user = User::where('email', $loginRequest->email)->first();
 
            if (! $user || ! Hash::check($loginRequest->password, $user->password)) {
                return response()->json([
                    'message'=>"Email ou de mot de passe incorrect!"
                ]);
            }

            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'user'=>$user,
                'token'=>$token
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        
    }
    //
}
