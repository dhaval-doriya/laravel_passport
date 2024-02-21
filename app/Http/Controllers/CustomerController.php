<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $customers = Customer::all();
            return response()->json([
                'data' => $customers,
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'type' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:customers,email',
                'password' => 'required|string',
                'profile_picture' => 'nullable|image',
            ]);

            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile_picture' => $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures') : null,
            ]);

            return response()->json([
                'data' => $customer,
                'type' => 'success'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'type' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return response()->json([
                'data' => $customer,
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'type' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:customers,email,' . $id,
                'password' => 'nullable|string',
                'profile_picture' => 'nullable|image',
            ]);

            $customer = Customer::findOrFail($id);

            $customer->name = $request->name;
            $customer->email = $request->email;
            if ($request->has('password')) {
                $customer->password = bcrypt($request->password);
            }
            if ($request->file('profile_picture')) {
                $customer->profile_picture = $request->file('profile_picture')->store('profile_pictures');
            }
            $customer->save();

            return response()->json([
                'data' => $customer,
                'type' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'type' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json([
                'data' => null,
                'type' => 'success'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'type' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
