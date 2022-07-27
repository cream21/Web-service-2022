<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    // tampil
    public function index()
    {
        $data = Gaji::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $data
        ], 200);
    }
   
    // create
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'masuk' => 'required',
            'sakit' => 'required',
            'izin' => 'required',
            'alpha' => 'required',
            'lembur' => 'required',
            'potongan_gaji' => 'required',
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Gaji::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update
    public function update(Request $request, $id)
    {
        $gaji = Gaji::find($id);
        // return response()->json(['pesan' => 'Data GET disimpan', 'data' => $gaji], 200);
        if (empty($gaji)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'masuk' => 'required',
                'sakit' => 'required',
                'izin' => 'required',
                'alpha' => 'required',
                'lembur' => 'required',
                'potongan_gaji' => 'required',
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $gaji->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $gaji], 200);
        }
    }
    //delete
    public function destroy($id)
   {
       $gaji = Gaji::find($id);
       if (empty($gaji)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       $gaji->delete();
       return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $gaji]);
   }
}
