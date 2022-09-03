<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function permission()
    {
        $permission = Role::with('permission')->get();

        // dd($permission->toArray());

        return view('permission.permission')->with([
           'permisson' => $permission  
        ]);
    }
}
