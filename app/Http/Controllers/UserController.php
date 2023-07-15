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
        // this regenerates only the CSRF token used for CSRF protection 
        $request->session()->regenerateToken();

        // redirect user to the root passing the message to the view
        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show login form
    public function login() {
        // user.login is a file directory user/login
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // attempts to authenticate the passed credentials: email and password
        if(auth()->attempt($formFields)) {
            // regenerates only the session ID effectively creating new session for user (not CSRF token)
            // regenerate() != regenerateToken()
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        // if authentication fails, redirect response to the user's previous location with error message and 
        // the old data in input element
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}
