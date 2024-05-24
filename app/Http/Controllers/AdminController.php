<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin_view');
    }

    public function list(User $user)
    {
        // Retrieve paginated user data ordered by creation date
        $users = User::latest('created_at')->paginate(10); // Change the number 10 to the desired number of users per page

        // Pass the paginated user data to the Blade view
        return view('user_list', [
            'users' => $users,
            'hasMorePages' => $users->hasMorePages()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^\S*$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])\S*$/'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            'username.regex' => 'The username cannot contain spaces.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character and cannot contain spaces.',
            'password.confirmed.regex' => 'The password confirmation does not match.',
        ]);

        // Create the user
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($user) {
            // If successful, redirect with success message
            return redirect()->back()->with('success', $user->username . ' has registered successfully.');
        } else {
            // If unsuccessful, redirect with error message
            return redirect()->back()->with('error', 'Failed to register user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('admin_change-password');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'exists:users,username', 'regex:/^\S*$/'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])\S*(?<!\s)$/'],
            'new_password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            // Custom error messages
            'new_password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character and cannot contain spaces.',
            'new_password_confirmation.regex' => 'The new password and confirmation password do not match.',
        ]);

        // Find the user by username
        $user = User::where('username', $request->username)->first();

        // If user is not found, return with an error message
        if (!$user) {
            return back()->withInput()->with('error', 'Username not found.');
        }

        // Check if the username is "admin"
        if ($request->username === 'admin') {
            return back()->withInput()->with('error', 'Password for the Admin cannot be changed.');
        }

        // Check if the new password is the same as the old one
        if (Hash::check($request->new_password, $user->password)) {
            // If the new password is the same as the old one, return with an error message
            return back()->withInput()->with('error', 'New password cannot be the same as the old password.');
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $saveResult = $user->save();

        // Check if the password was updated successfully
        if ($saveResult) {
            // Password updated successfully
            return redirect()->route('admin.change_password')->with('success', 'Password changed successfully.');
        } else {
            // Password update failed
            return back()->withInput()->with('error', 'Failed to update password.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Ensure the user is not attempting to delete themselves (optional)
        if ($user->username === auth()->user()->username) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        // Find the user by username
        $userToDelete = User::where('username', $user->username)->first();

        // Check if the user exists
        if (!$userToDelete) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete the user
        $userToDelete->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function delete(User $user)
    {
        // Check if the authenticated user is authorized to perform this action
        if (auth()->user()->username !== 'admin') {
            abort(403); // Unauthorized
        }

        // Retrieve paginated user data ordered by creation date
        $users = User::latest('created_at')->paginate(10); // Change the number 10 to the desired number of users per page

        // Pass the paginated user data to the Blade view
        return view('admin_delete', [
            'users' => $users,
            'hasMorePages' => $users->hasMorePages()
        ]);
    }

    public function search(Request $request)
    {
        $users = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $users->where(function ($query) use ($searchTerm) {
                $query->where('username', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $users->paginate(10);

        return view('admin_delete', compact('users'));
    }
}
