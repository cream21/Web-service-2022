<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
     // tampil
     public function index()
     {
         $data = golongan::all();
         return response()->json([
             'pesan' => 'Data Berhasil Ditemukan',
             'data' => $data
         ], 200);
     }
 // create
 public function store(Request $request)
 {
     $validasi = validator::make($request->all(), [
         'id_gaji' => 'required',
         'nama_golongan' => 'required',
         'tunjangan_suami_istri' => 'required',
         'tunjangan_anak' => 'required',
         'uang_makan' => 'required',
         'uang_lembur' => 'required',
     ]);
     if ($validasi->fails()) {
         return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
     }
     $data = Golongan::create($request->all());
     return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
 }
    // update
    public function update(Request $request, $id)
    {
        $golongan = Golongan::find($id);
        // return response()->json(['pesan' => 'Data GET disimpan', 'data' => $golongan], 200);
        if (empty($golongan)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'id_gaji' => 'required',
                'nama_golongan' => 'required',
                'tunjangan_suami_istri' => 'required',
                'tunjangan_anak' => 'required',
                'uang_makan' => 'required',
                'uang_lembur' => 'required',
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $golongan->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $golongan], 200);
        }
    }
    //delete
    public function destroy($id)
   {
       $golongan = Golongan::find($id);
       if (empty($golongan)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       $golongan->delete();
       return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $golongan]);
   }

   public function cek_relasi_pegawai()
   {
    $pegawais = Golongan::with('pegawai')->get();
    return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $pegawais]);
   }

   public function cek_relasi_gaji()
   {
    $pegawais = Golongan::with('gaji')->get();
    return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $pegawais]);
   }
}
