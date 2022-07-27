<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table="pegawai";
    protected $fillable=["nama_pegawai","jabatan","id_golongan","alamat","jenis_kelamin","status"];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class,'id_golongan');
    }
}
