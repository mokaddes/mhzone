<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function customerResetPasswordForm()
    {
        return view('auth.customer.email');
    }

    public function broker()
    {
        return Password::broker('users');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email'],[
                'email.required' => 'The :attribute field is required',
                'email.email' => 'The :attribute must be an email',
                'email.exists' => "The :attribute doesn't exists",
        ]);
    }


    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => ['Password throttled! Please try after sometime'],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Password throttled! Please try after sometime']);
    }
}
