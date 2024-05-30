<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\profileperusahaan;
use Illuminate\Http\Request;
use Validator;

class ProfilePerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = profileperusahaan::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia',
            ];

            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { try {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

      

        $data = profileperusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'deskripsi' => $request->deskripsi,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'image' => $request->image,

        ]);


        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Profile Perusahaan berhasil disimpan',
        ];

        return response()->json($response, 200);

    } catch (Exception $th) {
        $response = [
            'success' => false,
            'message' => 'Gagal menyimpan data',
        ];
        return response()->json($response, 500);
    }
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = profileperusahaan::find($id);
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia',
            ];

            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_perusahaan' => 'required',
                'deskripsi' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'jam_masuk' => 'required',
                'jam_pulang' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = profileperusahaan::find($id);
            $data->nama_perusahaan = $request->nama_perusahaan;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $data->deskripsi = $request->deskripsi;
            $data->jam_masuk = $request->jam_masuk;
            $data->jam_pulang = $request->jam_pulang;
            $data->save();


            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Perusahaan berhasil disimpan',
            ];

            return response()->json($response, 200);

        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => 'Data Perusahaan tidak ditemukan',
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $save = profileperusahaan::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'Sukses menghapus data',
            ];
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
    }
}
