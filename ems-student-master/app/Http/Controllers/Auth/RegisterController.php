<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'nid' => 'required',
            'ihrm_no' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
            'name' => $data['fname'],
            'email' => $data['email'],
            'password' => Hash::make($data['nid']),
        ]);
        Member::create([
            'user_id'=>$user->id,
            'fname'=>$data['fname'],
            'dob'=>$data['dob'],
            'nid'=>$data['nid'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'ihrm_no'=>$data['ihrm_no'],
        ]);
        return $user;
    }
}
