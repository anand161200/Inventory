<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function rolePermission($id)
    {
        $permission = Role::with('permission')
        ->where('id',$id)
        ->first();

        return response()->json([
            'role_permission'  => $permission,
            'all_permission'  => Permission::all()

        ],200); 
    }

    function permission()
    {
        return view('role_permission.role_permission')->with([
            'all_role' => Role::all()
        ]);
    }

    function checkPermission()
    {
        return response()->json([
            'all_permission'  => Permission::all(),
        ],200);  
    }
}
