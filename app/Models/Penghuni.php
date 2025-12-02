<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Penghuni extends Authenticatable
{
    protected $table = 'penghuni';
    protected $primaryKey = 'id_penghuni';
    public $timestamps = false;

    protected $fillable = [
        'nama_penghuni', 
        'no_telepon_penghuni', 
        'tanggal_masuk', 
        'status_keaktifan',
        'no_kamar'
    ];

    public function getAuthPassword()
    {
        return $this->no_telepon_penghuni;
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_penghuni', 'id_penghuni');
    }

    public function pekerja()
    {
        return $this->hasOne(Pekerja::class, 'id_penghuni', 'id_penghuni');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar', 'no_kamar');
    }
}