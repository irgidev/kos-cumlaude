<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    protected $table = 'pekerja';
    
    protected $primaryKey = 'id_penghuni';
    
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'id_penghuni', 
        'nama_perusahaan', 
        'jabatan'
    ];
}