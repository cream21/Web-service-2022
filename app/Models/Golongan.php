<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table="golongan";
    protected $fillable=["id_gaji","nama_golongan","tunjangan_suami_istri","tunjangan_anak","uang_makan","uang_lembur"];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class,"id_golongan");
    }
    
    public function gaji()
    {
        return $this->belongsTo(Gaji::class,'id_gaji');
    }

}
