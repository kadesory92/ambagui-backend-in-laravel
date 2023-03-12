<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validations = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'passportNum' => 'required|unique:users|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        if($validations->fails()){
            $errors=$validations->errors();

            return response()->json([
                'errors'=>$errors,
                'status'=>401
            ]);
        }

        if($validations->passes()){
            $user=User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'passportNum' => $request->passportNum,
                //'gender' => $gender,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                //'utype' => $utype
            ]);

            $token=$user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token'=>$token,
                'type'=>'bearer'
            ]);

        }
        
    }
    //
}
