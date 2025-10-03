<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'waktu_pemeriksaan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function paket_lab()
    {
        return $this->hasOne(JenisPemeriksaan::class, 'id', 'id_paket');
    }
}
