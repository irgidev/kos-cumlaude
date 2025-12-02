<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'no_kamar';
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'no_kamar', 'tipe', 'harga_sewa', 'status_ketersediaan'
    ];

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'no_kamar', 'no_kamar');
    }

    // RELASI BARU: Untuk mengetahui siapa penghuni kamar ini
    public function penghuni()
    {
        // hasOne karena 1 kamar hanya ditempati 1 penghuni aktif (biasanya)
        return $this->hasOne(Penghuni::class, 'no_kamar', 'no_kamar')->where('status_keaktifan', 'Aktif');
    }
}