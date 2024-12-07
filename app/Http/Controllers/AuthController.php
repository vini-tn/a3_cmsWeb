<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//MCV - Controller of Auth (Users)
class AuthController extends Controller
{
    //This function is for processing a new user into the user database. This is called in the web routes for post register.
    public function register(Request $request){
     
        //fields used to create new user. This is a validation checker to ensure correct format of inputs have been entered for each field.
        $fields = $request ->validate([
            'username' =>['required','max:255', 'unique:users'],
            'email' =>['required','max:255', 'email','unique:users'],
            'password' =>['required','min:5', 'confirmed'],
        ]);

        //create user with entered fields
        $user = User::create($fields);

        //Login new created user into site
        Auth::login($user);

        //Display the home page (posts) to user
        return redirect()->route('posts.index');
    }

    //This function is for logging in an existing user into the site. This is called in the web routes for post login.
    public function login(Request $request)
    {
        //fields used to validate and process user details
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);


        //if Remember Me is checked, the user is saved in login, even when server is stopped. They'll only be logout when logout is clicked.
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended('dashboard');
        //return error if no matching email and password
        } else {
            return back()->withErrors([
                'failed' => 'Invalid email or password'
            ]);
        }
    }

    //This function is for logging out the logged in user. The session becomes invalidated for guests, token is reset and the home (posts) page is shown. This is called in the web routes for post logout.
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
