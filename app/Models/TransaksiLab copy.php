<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLab extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab';
    protected $primaryKey = 'id_transaksi_lab';
    protected $guarded = [];

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function petugas()
    {
        return $this->hasOne(PetugasLab::class, 'id_petugas_lab', 'id_petugas_lab');
    }

    public function ruangan()
    {
        return $this->hasOne(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }
    public function status_asuransi()
    {
        return $this->hasOne(StatusAsuransi::class, 'id_asuransi', 'id_status');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function dokter_pj()
    {
        return $this->hasOne(DokterPJ::class, 'id', 'id_dokter');
    }
    public function cara_masuk()
    {
        return $this->belongsTo(CaraMasuk::class, 'id_cara_masuk', 'id');
    }

    public function transaksi_lab_kultur()
    {
        return $this->hasOne(TransaksiLabKultur::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }

    public function detail()
    {
        return $this->hasMany(TransaksiLabDetail::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }

    public function detail_paket()
    {
        return $this->hasMany(TransaksiPaketLab::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }

    public function prioritas()
    {
        return $this->hasOne(StatusCito::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }

    public function kelas()
    {
        return $this->hasOne(KelasPasien::class, 'id', 'id_kelas');
    }

    public function instalasi()
    {
        return $this->hasOne(Instalasi::class, 'id', 'id_instalasi');
    }

    public function transaksi_paket_lab()
    {
        return $this->hasOne(TransaksiPaketLab::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }
    public function tat()
    {
        return $this->hasOne(TAT::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }
    public function histori()
    {
        return $this->hasMany(Histori::class, 'id_transaksi_lab');
    }

}
