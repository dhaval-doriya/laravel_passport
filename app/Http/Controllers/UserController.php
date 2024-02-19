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
        $users = User::with('roles')->get();
        return response()->json(['users' => $users]);
    }



    public function getPermissions(Request $request)
    {   
        $permissions = Permission::all();
        return response()->json(['data' => $permissions]);
    }

    public function getRoles(Request $request)
    {   
        $role =  Role::first()->with('permission');
        return response()->json(['data' => Role::with('permissions')->get() ]);
    }


     //update user and role
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
        return response()->json(['data' => $role->with('permissions')]);
    }
       
}
