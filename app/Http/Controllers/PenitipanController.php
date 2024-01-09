<?php

namespace App\Http\Controllers;

use App\Models\Penitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PenitipanController extends Controller
{
    public function index()
    {
        $dataPenitipan = Penitipan::with(['hewan'])
            ->orderBy('hewan_id', 'DESC')
            ->get();
        $response = [
            'success' => true,
            'message' => 'welcome your data Penitipan!',
            'data' => $dataPenitipan
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemilik' => 'required|string',
            'tanggal' => 'required',
            'hewan_id' => 'required|integer',
        ]);

        $nama_pemilik = $request->input('nama_pemilik');
        $tanggal = $request->input('tanggal');
        $hewan_id = $request->input('hewan_id');
        $pecah_id_hewan = explode('-', $hewan_id);

        $penitipan = Penitipan::create([
            'nama_pemilik' => $nama_pemilik,
            'tanggal' => $tanggal,
            'hewan_id' => $pecah_id_hewan[0],
        ]);

        $response = [
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => [
                'nama_pemilik' => $penitipan->nama_pemilik,
                'tanggal' => $penitipan->tanggal,
                'hewan_id' => $penitipan->hewan_id,
            ],
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemilik' => 'required|string',
            'tanggal' => 'required',
            'hewan_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nama_pemilik = $request->input('nama_pemilik');
        $tanggal = $request->input('tanggal');
        $hewan_id = $request->input('hewan_id');
        $pecah_id_hewan = explode('-', $hewan_id);

        $penitipan = Penitipan::find($id);

        if (!$penitipan) {
            return response()->json(['error' => 'Data Penitipan not found'], 404);
        }

        $penitipan->nama_pemilik = $nama_pemilik;
        $penitipan->tanggal = $tanggal;
        $penitipan->hewan_id = $pecah_id_hewan[0];
        $penitipan->save();

        $response = [
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => [
                'nama_pemilik' => $penitipan->nama_pemilik,
                'tanggal' => $penitipan->tanggal,
                'hewan_id' => $penitipan->hewan_id,
            ],
        ];

        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $penitipan = Penitipan::find($id);

        if (!$penitipan) {
            return response()->json(['error' => 'Data Penitipan not found'], 404);
        }

        $penitipan->delete();

        $response = [
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ];

        return response()->json($response, 200);
    }
}
