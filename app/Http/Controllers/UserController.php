<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        return view('client_side.home');
    }

    public function registerForm()
    {
        return view('auth.register'); 
    }
    
    public function register(Request $request)
    {
        $request->validate([
            
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'Gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|numeric',
            'password' => 'required',
            'cofirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->address = $request->address;
        $user->Gender = $request->Gender;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login_form');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect()->route('home');
        }
        return back()->with('error', 'Email or passsword inccorect.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login_form');
    }
}
