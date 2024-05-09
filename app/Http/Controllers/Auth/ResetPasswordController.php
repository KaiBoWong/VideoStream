<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function reset(Request $request)
    {
        // Validation rules including a custom rule for special character
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])\S*$/'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            // Custom error message for special character requirement
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character and cannot contain spaces.',
            'password.confirmed.regex' => 'The password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Flash success message
        return redirect()->route('home')->with('success', 'Password reset successfully.');
    }
}
