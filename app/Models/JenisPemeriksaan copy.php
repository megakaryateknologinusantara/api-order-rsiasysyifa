<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pemeriksaan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function waktu_paket()
    {
        return $this->hasOne(WaktuPemeriksaan::class, 'id_paket', 'id');
    }
}
