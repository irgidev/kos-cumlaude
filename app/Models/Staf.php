<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staf extends Authenticatable
{
    protected $table = 'staf';
    protected $primaryKey = 'id_staf';
    public $timestamps = false;

    protected $fillable = [
        'nama_staf',
        'peran',
        'no_telepon_staf',
    ];

    public function getAuthPassword()
    {
        return $this->no_telepon_staf;
    }
}