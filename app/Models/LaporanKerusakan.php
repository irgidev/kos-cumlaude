<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKerusakan extends Model
{
    protected $table = 'laporan_kerusakan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = false;

    protected $fillable = [
        'id_penghuni', 
        'no_kamar', 
        'id_staf', 
        'id_fasilitas',
        'deskripsi', 
        'tanggal_lapor', 
        'status_laporan'
    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'id_penghuni', 'id_penghuni');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar', 'no_kamar');
    }
    
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'id_staf', 'id_staf');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }
}