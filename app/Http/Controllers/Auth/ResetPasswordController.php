<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // Retrieve the authenticated user
        $user = Auth::user();
        
        // Validation rules including a custom rule for special character
        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])\S*$/'],
            'new_password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            // Custom error message for special character requirement
            'new_password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character and cannot contain spaces.',
            'new_password_confirmation.regex' => 'The password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withInput()->with('error', 'No user found with the provided email.');
        }

        // Check if the new password is the same as the old password
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withInput()->with('error', 'New password cannot be the same as the old password.');
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        // Flash success message
        return redirect()->route('home')->with('success', 'Password reset successfully.');
    }
}
