<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    //Display the registration page;
    public function show(){
        return view('auth.register');
    }

    //handle account registration form
    public function register(RegisterRequest $request){
        $user= User::create($request->validated());
        auth()->login($user);

        return redirect('/')->with('success',"Account created successfully!");

    }
}
