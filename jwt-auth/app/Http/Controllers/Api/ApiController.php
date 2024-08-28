<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //Register API - POST (name, email, password)
    public function register(Request $request)
    {
            $request->validate([
                "name" => "required|string",
                "email" => "required|string|email|unique:users",
                "password" => "required|confirmed"
            ]);

            //User model to save user in database
           $data =   User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password)
            ]);
            return response([
                "status" => true,
                "message" => "User created successfully",
                "data" =>$data
            ]);
    }

    //Login API - POST (email, password)
    public function login(Request $request)
    {
        //validation

            $request->validate([
                "email" => "required|string|email|required",
                'password' => 'required'
                ]);

               //Auth Facade
               $token = Auth::attempt([
                "email" => $request->email,
                "password" => $request->password
               ]);

            if(!$token){
                return response()->json([
                    'status' => false,
                    'message' => "Invalid login credentials"
                ]);
            }
            return response()->json([
                "status" => true,
                "message" => "User Logged In",
                "token" => $token
            ]);
    }

    //Profile API - GET JWT Auth Token)
    public function profile()
    {

    }

    //Refresh Token API - GET(JWT Auth Token)
    public function refreshToken()
    {

    }

    //Logout API - GET (JWT Auth Token)
    public function logout()
    {

    }
}