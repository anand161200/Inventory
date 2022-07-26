<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFromRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function index()
    {
        return view('role_permission.index');
    }

    public function roleList()
    {
        return response()->json([
            'role' => Role::all()
        ],200);
    }

    function roleDetails($id)
    {
        $Role_name= Role::find($id);
        return response()->json([
            'details'  => $Role_name
        ],200); 
    }

    function addOrupdate(RoleFromRequest $request)
    {
        $role = $request->id !== null ? Role::find($request->id) : new Role();
        $role->fill($request->getRequestFiled())->save();

        return response()->json([
            'Record add and update successfully'  
        ],200);
    }

    public function deleteRole(Request $request)
    {
        $deleterecord=Role::find($request->role_id);
        $deleterecord->delete();

        return response()->json([
            'data' => $deleterecord 
        ],200);
    }
}
