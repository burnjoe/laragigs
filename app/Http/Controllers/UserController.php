<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    // Show register/create form
    public function create() {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],       // users table, email column
            // ['required', 'confirmed', 'min:6']
            'password' => 'required|confirmed|min:6'
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);                  // hashes the password 
        
        // create user
        $user = User::create($formFields);

        // authenticate user login
        auth()->login($user);

        // redirect user with a message:
        return redirect('/')->with('message', 'User created and logged in.');
    }

    // Log user out
    public function logout(Request $request) {
        // authenticate user logout
        auth()->logout();

        // this destroys the current session. 
        // removing all data associated with the session and marks it as invalid
        $request->session()->invalidate();
        // this regenerates session ID and CSRF token
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

}
