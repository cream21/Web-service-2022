<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table="gaji";
    protected $fillable=["masuk","sakit","izin","alpha","lembur","potongan_gaji"];

    public function golongan()
    {
        return $this->hasMany(Gaji::class);
    }
}
