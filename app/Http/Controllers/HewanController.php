<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HewanController extends Controller
{
      public function index()
      {
            $dataHewan = Hewan::all();
            $response = [
                  'success' => true,
                  'message' => 'welcome your data Hewan!',
                  'data' => $dataHewan
            ];
            return response()->json($response, 200);
      }


      public function store(Request $request)
      {
            $validator = Validator::make($request->all(), [
                  'nama' => 'required|string',
                  'jenis_kelamin' => 'required|string',
                  'tanggal_lahir' => 'required',
                  'foto' => 'required',
            ]);

            $hewan = Hewan::create([
                  'nama' => $request->nama,
                  'jenis_kelamin' => $request->jenis_kelamin,
                  'tanggal_lahir' => $request->tanggal_lahir,
                  'foto' => $request->foto,
            ]);
            $response = [
                  'success' => true,
                  'message' => 'Data berhasil ditambahkan',
                  'data' => [
                        'nama' => $hewan->nama,
                        'jenis_kelamin' => $hewan->jenis_kelamin,
                        'tanggal_lahir' => $hewan->tanggal_lahir,
                        'foto' => $hewan->foto,
                        'updated_at' => $hewan->updated_at,
                        'created_at' => $hewan->created_at,
                        'id' => $hewan->id,
                  ],
            ];

            return response()->json($response, 200);
      }

      public function update(Request $request, $id)
      {
            $validator = Validator::make($request->all(), [
                  'nama' => 'required|string',
                  'jenis_kelamin' => 'required',
                  'tanggal_lahir' => 'required',
                  'foto' => 'required',
            ]);

            if ($validator->fails()) {
                  return response()->json(['error' => $validator->errors()], 400);
            }

            $hewan = Hewan::find($id);

            if (!$hewan) {
                  return response()->json(['error' => 'Data Hewan not found'], 404);
            }

            $hewan->nama = $request->nama;
            $hewan->jenis_kelamin = $request->jenis_kelamin;
            $hewan->tanggal_lahir = $request->tanggal_lahir;
            $hewan->foto = $request->foto;
            $hewan->save();

            $response = [
                  'success' => true,
                  'message' => 'Data berhasil diupdate',
                  'data' => [
                        'nama' => $hewan->nama,
                        'jenis_kelamin' => $hewan->jenis_kelamin,
                        'tanggal_lahir' => $hewan->tanggal_lahir,
                        'foto' => $hewan->foto,
                        'updated_at' => $hewan->updated_at,
                        'created_at' => $hewan->created_at,
                        'id' => $hewan->id,
                  ],
            ];

            return response()->json($response, 200);
      }

      public function destroy($id)
      {
            $hewan = Hewan::find($id);

            if (!$hewan) {
                  return response()->json(['error' => 'Data Hewan not found'], 404);
            }

            $hewan->delete();

            $response = [
                  'success' => true,
                  'message' => 'Data berhasil dihapus',
            ];

            return response()->json($response, 200);
      }
}
