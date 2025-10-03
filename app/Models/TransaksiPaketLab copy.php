<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPaketLab extends Model
{
    use HasFactory;
    protected $table = 'transaksi_paket_lab';
    protected $primaryKey = 'id_transaksi_paket_lab';
    protected $guarded = [];

    public function transaksi_lab()
    {
        return $this->hasOne(TransaksiLab::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }

    public function paket_lab()
    {
        return $this->hasOne(JenisPemeriksaan::class, 'kode_his', 'id_paket_lab');
    }

    public function harga_kultur()
    {
        return $this->hasOne(HargaKultur::class, 'id_harga_kultur', 'id_harga_kultur');
    }
}
