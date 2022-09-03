<?php

namespace App\Http\Controllers;

use App\Models\Role;
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

        $role = Role::where('name','=','user')->first();

        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->address = $request->address;
        $user->Gender = $request->Gender;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->password = bcrypt($request->password);
        $user->role_id = $role->id;
        $user->save();

        return redirect()->route('login_form');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $admin = Role::where('name','=','admin')->first();
      
        $request->validate([

            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            if(Auth::user()->role_id == $admin->id)
            {
                return redirect()->route('index');
            }
            
            return redirect()->route('home');
        }
        return back()->with('error', 'Email or passsword inccorect.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login_form');
    }

    // admin side
     
    function index()
    {
        return view('admin.user.index')->with([
            'role' => Role::all()
        ]);
    }

    function userList()
    {
        return response()->json([
            'user_list' => User::with('role')->get()
        ],200);
    }

    function userDetails($id)
    {
        $user_data= User::find($id);

        return response()->json([
            'details'  => $user_data,
        ],200); 
    }

    function addOrupdate(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'Address' => 'required',
            'gender' => 'required',
            'Email' => 'required',
            'phonenumber' => 'required',
            'Password' => 'required',
            'select_name' => 'required',
        ]);

        $user = $request->id !== null ? User::find($request->id) : new User();
        $user->fill([
            'firstName'=>$request->firstname,
            'lastName'=>$request->lastname,
            'address'=>$request->Address,
            'Gender'=>$request->gender,
            'email'=>$request->Email,
            'phoneNumber'=>$request->phonenumber,
            'password'=>bcrypt($request->Password),
            'role_id'=>$request->select_name,
        ])->save();

        return response()->json([
            'Record add and update successfully'  
        ],200);
    }

    function deleteUser(Request $request)
    {
        $deleterecord=User::find($request->user_id);
        $deleterecord->delete();

        return response()->json([
            'data' => $deleterecord 
        ],200);
    }
}
