<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    public $timestamps = false;

    protected $fillable = ['no_kamar', 'nama_fasilitas', 'kondisi'];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar', 'no_kamar');
    }
}