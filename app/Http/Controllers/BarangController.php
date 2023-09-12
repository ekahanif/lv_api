<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::get();
        return response()->json([
            "data" => $barang
        ]);
    }
    public function store(Request $request)
    {
        $barang = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth' => $request->birth,
        ]);

        return response()->json([
            "data" => $barang
        ]);
    }

    public function show(Customer $barang)
    {
        return response()->json([
            "data" => $barang
        ]);
    }


    public function update(Request $request, Customer $barang)
    {
        $barang->name = $request->name;
        $barang->email = $request->email;
        $barang->birth = $request->birth;
        $barang->save();
        return response()->json([
            "data" => $barang
        ]);
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
       return response()->json([
        "Message" => "Berhasil Hapus"
       ], 204);
    }
}
