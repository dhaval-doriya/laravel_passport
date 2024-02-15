<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    

    public function getProducts(Request $request)
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }


    public function getPermissions(Request $request)
    {
        return response()->json(['data' => Permission::all()]);
    }

    public function getRoles(Request $request)
    {
        return response()->json(['data' => Role::with('permission')->get() ]);
    }


     //update role and permission
     public function updateUser(Request $request , User $user)
     {
        $user->update($request->all());
        $user->roles()->sync($request->roles);
        return response()->json(['data' => $user]);
     }
     
    //update role and permission
    public function updateRole(Request $request ,Role $role)
    {   
        $role->permission()->sync($request->permissions);
        return response()->json(['data' => $role->with('permission')]);
    }
       
}
