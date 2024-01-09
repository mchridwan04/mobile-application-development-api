<?php

namespace App\Http\Controllers;

use App\Models\Makananan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MakanananController extends Controller
{
    public function index()
    {
        $dataMakanan = Makananan::all();
        $response = [
            'success' => true,
            'message' => 'welcome your data Makanan!',
            'data' => $dataMakanan
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'stock' => 'required',
            'foto_makanan' => 'required',
        ]);

        $makanan = Makananan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'stock' => $request->stock,
            'foto_makanan' => $request->foto_makanan,
        ]);

        $response = [
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => [
                'nama' => $makanan->nama,
                'jenis' => $makanan->jenis,
                'stock' => $makanan->stock,
                'foto_makanan' => $makanan->foto_makanan,
                'id' => $makanan->id,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'stock' => 'required',
            'foto_makanan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $makanan = Makananan::find($id);

        if (!$makanan) {
            return response()->json(['error' => 'Data Makanan not found'], 404);
        }

        $makanan->nama = $request->nama;
        $makanan->jenis = $request->jenis;
        $makanan->stock = $request->stock;
        $makanan->foto_makanan = $request->foto_makanan;
        $makanan->save();

        $response = [
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => [
                'nama' => $makanan->nama,
                'jenis' => $makanan->jenis,
                'stock' => $makanan->stock,
                'foto_makanan' => $makanan->foto_makanan,
                'id' => $makanan->id,
            ],
        ];

        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $makanan = Makananan::find($id);

        if (!$makanan) {
            return response()->json(['error' => 'Data Makanan not found'], 404);
        }

        $makanan->delete();

        $response = [
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ];

        return response()->json($response, 200);
    }
}
