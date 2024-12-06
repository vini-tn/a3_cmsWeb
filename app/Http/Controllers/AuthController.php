<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
     
        // Validate
        $fields = $request ->validate([
            'username' =>['required','max:255'],
            'email' =>['required','max:255', 'email','unique:users'],
            'password' =>['required','min:5', 'confirmed'],
        ]);

        //Register
        $user = User::create($fields);

        //Login
        Auth::login($user);

        //Redirect

        return redirect()->route('posts.index');
    }

    //login 
    public function login(Request $request)
    {
        // Validate
        $fields = $request->validate([

            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);


        //Try to login the user
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'Invalid password or email'
            ]);
        }
    }

    //Logout 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
