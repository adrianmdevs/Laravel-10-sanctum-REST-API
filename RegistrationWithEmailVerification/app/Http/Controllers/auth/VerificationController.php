<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //Instantiating a new VerificationController instance.

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Display an email verification notice.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notice(Request $request): \Illuminate\Http\RedirectResponse
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->route('home') : view('auth.verify-email');
    }

    /**
     * User's email verificaiton.
     *
     * @param  \Illuminate\Http\EmailVerificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home');
    }

    /**
     * Resent verification email to user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request): \Illuminate\Http\Response
    {
        $request->user()->sendEmailVerificationNotification();
        return back()
            ->withSuccess('A fresh verification link has been sent to your email address.');
    }
}
