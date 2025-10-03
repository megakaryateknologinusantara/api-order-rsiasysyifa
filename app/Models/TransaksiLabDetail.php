<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_detail';
    protected $primaryKey = 'id_transaksi_lab_detail';
    protected $guarded = [];

    public function transaksi_lab()
    {
        return $this->hasOne(TransaksiLab::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }

    public function kode_lab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function validator()
    {
        return $this->hasOne(User::class, 'id', 'user_validasi');
    }

    public function alat_detail()
    {
        return $this->hasOne(KategoriAlatDetail::class, 'id_kode_lab', 'id_kode_lab');
    }
}
