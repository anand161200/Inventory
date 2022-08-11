<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('client_side.home');
    }

    public function product()
    {
        return view('client_side.product'); 
    }

    public function loginForm()
    {
        return view('auth.login');
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
    }
}
