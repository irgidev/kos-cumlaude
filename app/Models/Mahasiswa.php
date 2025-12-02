<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
    protected $primaryKey = 'id_penghuni';
    
    public $incrementing = false; 
    
    public $timestamps = false;

    protected $fillable = [
        'id_penghuni', 
        'nim', 
        'nama_universitas'
    ];
}