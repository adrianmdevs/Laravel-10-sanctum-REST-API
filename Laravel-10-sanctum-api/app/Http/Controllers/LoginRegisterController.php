<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\WebRequestRecognizerTrait;
use Validator;

class LoginRegisterController extends Controller
{
    public function register(Request $request){
        $validate = Validator::make($request->all(),[
            'name'=>'required|string|max:250',
            'email'=>'required|string|email:rfc,dns|max:250|unique:users,email',
            'password'=>'required|string|min:8|confirmed'
        ]);
      WebRequestRecognizerTrait 
        if($validate->fails()){
            return response()->json([
                'status'=>'failed',
                'message'=>'validation Error',
                'data'=>$validate->errors(),
            ],403);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $data['token']=$user->createToken($request->email)->plainTextToken;
        $data['user']= $user;

        $response = [
            'status'=>'success',
            'message'=>'User has been created successfully',
            'data'=>$data,
        ];
        return response()->json($response,201);
    }

    //Authenticatating the user
    public function Login(Request $request){
        $validate = Validator::make($request->all(),[ 
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>'Failed',
                'message'=>'Validation Error',
                'data'=>$validate->errors()
            ],403);
        }
        //Checking  if Email exists
        $user = User::where('email',$request->email)->first();
        //Checking password
        if (!$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'status'=>'failed',
                'message'=>'invalid credentials'
            ],401);
        }
        $data['token']= $user->createToken($request->email)->plainTextToken;
        $data['user']= $user;

        $response = [
            'status'=>'success',
            'message'=>'Successful login',
            'data'=>$data
        ];
        return response()->json($response,200);
    }

    //Logging the user From the application

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>'Success',
            'Message'=>'user has been logged out successfully'
        ], 200);
    }
}
