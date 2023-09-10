<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::paginate(10);
        return response()->json([
            "data" => $customer
        ]);
    }

    public function store(Request $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth' => $request->birth,
        ]);

        return response()->json([
            "data" => $customer
        ]);
    }

    public function show(Customer $customer)
    {
        return response()->json([
            "data" => $customer
        ]);
    }


    public function update(Request $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->birth = $request->birth;
        $customer->save();
        return response()->json([
            "data" => $customer
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
       return response()->json([
        "Message" => "Berhasil Hapus"
       ], 204);
    }
}