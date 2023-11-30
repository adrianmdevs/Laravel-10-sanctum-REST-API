<?php

namespace App\Http\Controllers;

use App\Member;
use App\Notifications\Users\ActivateEmailNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'fname.required' => 'full name is required',
            'dob' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'nid' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      //  dd($request->all());
        try {
            $user = User::create([
                'name' => $request->fname,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user_id = $user->id;
            $request->request->add(['user_id' => $user_id]);
            Member::create(array_merge($request->all()));
            $user->notify(new ActivateEmailNotification($user));
            return redirect('/')->with('success', 'Registration is successful, please check your email for a verification link.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during submission, Please try again.');
        }
    }

    public function verify_email(Request $request, $user)
    {
        if (!$request->hasValidSignature()) {
            return redirect('/')->with('error', 'This link is not valid.');
        }
//dd($request->user);
        User::find($request->user)->update([
            'is_activated' => true
        ]);
        return redirect('/')->with('success', 'Your account is now activated!');
    }

    public function resend(Request $request)
    {
        return view('auth.verify');

    }

    public function resend_verification(Request $request)
    {
        $request->user()->notify(new ActivateEmailNotification($request->user()));

        return back()->with('success', 'Account verification link has been sent to your email address!');

    }

}
