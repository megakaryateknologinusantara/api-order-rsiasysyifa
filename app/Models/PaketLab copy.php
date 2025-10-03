<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLab extends Model
{
    use HasFactory;

    protected $table = 'paket_lab';
    protected $primaryKey = 'id_paket_lab';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function waktu_paket()
    {
        return $this->hasOne(WaktuPemeriksaan::class, 'id_paket', 'id_paket_lab');
    }

    public function userupdate()
    {
        return $this->hasOne(User::class, 'id', 'user_update');
    }

    public function jenis()
    {
        return $this->hasOne(JenisPemeriksaan::class, 'kode_his', 'no_jenis');
    }

    public function paket_lab_detail()
    {
        return $this->hasMany(PaketLabDetail::class, 'id_paket_lab'); // id_paket_lab adalah foreign key
    }
}
