<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    public $timestamps = false;

    protected $fillable = ['id_penghuni', 'periode', 'nominal_tagihan', 'status_bayar'];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'id_penghuni', 'id_penghuni');
    }
}