<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('client_side.home');
    }

   
    public function checkout()
    {
        return view('client_side.checkout'); 
    }

    public function cart()
    {
        return view('client_side.cart'); 
    }

    public function product()
    {
        return view('client_side.product'); 
    }


    
}
