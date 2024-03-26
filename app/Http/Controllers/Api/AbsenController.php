<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Validator;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Absen::all();
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
    {
        
        //isikan kode berikut
        try {
            //cek apakah request berisi nama_role atau tidak
            $validator = Validator::make($request->all(), [
                'users_id' => 'required',
                'lokasi_user' => 'required',
                'waktu_absen_masuk' => 'required',
                
                'tanggal_hari_ini' => 'required',
                


            ]);
            
            //kalau tidak akan mengembalikan error
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            
            //kalau ya maka akan membuat roles baru
            $data = Absen::create([
                'users_id' => $request->users_id,
                'lokasi_user' => $request->lokasi_user,
                'waktu_absen_masuk' => $request->waktu_absen_masuk,
                
                'tanggal_hari_ini' => $request->tanggal_hari_ini,


            ]);
            
            //data akan di kirimkan dalam bentuk response list
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data berhasil di simpan',
            ];
            
            //jika berhasil maka akan mengirimkan status code 200
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            //jika error maka akan mengirimkan status code 500
            return response()->json($response, 500);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Absen::find($id);
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
                'users_id' => 'required',
                'lokasi_user' => 'required',
                'waktu_absen_masuk' => 'required',
                'waktu_absen_pulang' => 'required',
                'tanggal_hari_ini' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = Absen::find($id);
            //$data->users_id = $request->users_id;
            $data-> users_id = $request->users_id;
            $data-> lokasi_user = $request->lokasi_user;
            $data-> waktu_absen_masuk = $request->waktu_absen_masuk;
            $data-> waktu_absen_pulang = $request->waktu_absen_pulang;
            $data-> tanggal_hari_ini = $request->tanggal_hari_ini;
            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data berhasil di ubah',
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $save = Absen::find($id);
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
