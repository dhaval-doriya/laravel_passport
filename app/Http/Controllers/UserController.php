<?php

namespace App\Http\Controllers;

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

}
