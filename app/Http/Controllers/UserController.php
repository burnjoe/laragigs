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

        // login
        auth()->login($user);

        // redirect user with a message:
        return redirect('/')->with('message', 'User created and logged in.');
    }

}
