<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use \Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required',
                'confirm_password' => 'required | same:password',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('auth_token')->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json(['data' => $success, "message" => "register success"]);
    }
    public function login(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'email' =>'required|string|email|max:255',
                'password' => 'required',
            ]
        );  

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('auth_token')->plainTextToken;
            $success['name'] =  $user->name;
            return response()->json(['data' => $success, "message" => "login success"]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}