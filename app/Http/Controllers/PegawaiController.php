<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PegawaiController extends Controller

{
     // tampil
     public function index()
     {
         $data = Pegawai::all();
         return response()->json([
             'pesan' => 'Data Berhasil Ditemukan',
             'data' => $data
         ], 200);
     }
// create
public function store(Request $request)
{
    $validasi = validator::make($request->all(), [
        'nama_pegawai' => 'required',
        'jabatan' => 'required',
        'id_golongan' => 'required',
        'alamat' => 'required',
        'jenis_kelamin' => 'required',
        'status' => 'required',
    ]);
    if ($validasi->fails()) {
        return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
    }
    $data = Pegawai::create($request->all());
    return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
}
   // update
   public function update(Request $request, $id)
   {
       $Pegawai = Pegawai::find($id);
       // return response()->json(['pesan' => 'Data GET disimpan', 'data' => $Pegawai], 200);
       if (empty($Pegawai)) {
           return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
       } else {
           $validasi = Validator::make($request->all(), [
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'id_golongan' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
           ]);
           if ($validasi->fails()) {
               return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
           }
           $Pegawai->update($request->all());
           return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $Pegawai], 200);
       }
   }

   public function destroy($id)
   {
       $Pegawai = Pegawai::find($id);
       if (empty($Pegawai)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       $Pegawai->delete();
       return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $Pegawai]);
   }

   public function cek_relasei()
   {
    $pegawais = Pegawai::with('golongan')->get();
    return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $pegawais]);
   }
}
