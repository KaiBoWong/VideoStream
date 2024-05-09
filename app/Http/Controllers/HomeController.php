<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->username === 'admin') {
            // Redirect the admin user to the admin dashboard
            return redirect()->route('admin.users.index');
        }

        return view('home');
    }
    public function showProfile()
    {
        $user = auth()->user();

        // Pass the user data to the view
        return view('profile', ['user' => $user]);
    }

    public function changePassword()
    {
        return view('change-password');
    }

    protected function updatePassword(Request $request)
    {
        //dd($request->new_password);

        // Validation rules including a custom rule for no spaces
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])\S*(?<!\s)$/'],
            'new_password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            // Custom error messages
            'new_password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character and cannot contain spaces.',
            'new_password_confirmation.regex' => 'The new password and confirmation password do not match.',
        ]);

        // Password change logic remains the same
        $user = Auth::user();
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withInput()->with('error', 'Your current password does not match our records.');
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('change.password')->with('success', 'Password changed successfully.');
    }

}
