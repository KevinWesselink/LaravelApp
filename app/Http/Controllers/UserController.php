<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Show Users Profile
    public function show() {
        return view('users.profile');
    }

    // Show Edit Form
    public function edit(User $user) {
        return view('users.edit', ['user' => $user]);
    }

    // Update User Data
    public function update(Request $request, User $user) {

        // Make sure logged in user is owner
        if ($user->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required|confirmed'
        ]);

        $user->update($formFields);

        return back()->with('message', 'User updated successfully!');
    }

    // Delete User
    public function destroy(Request $request, User $user) {
        // Make sure logged in user is owner
        if ($user->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        // logout(Request $request);

        // $user->delete();
        return redirect('/')->with('message', 'User deleted successfully!');
    }
}
