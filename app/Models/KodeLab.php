<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeLab extends Model
{
    use HasFactory;

    protected $table = 'kode_lab';
    protected $primaryKey = 'id_kode_lab';
    protected $guarded = [];

    public function sub_kategori()
    {
        return $this->hasOne(SubKategori::class, 'id_sub_kategori', 'id_sub_kategori');
    }

    public function grub_detail()
    {
        return $this->hasOne(GrubDetail::class, 'id_kode_lab', 'id_kode_lab');
    }

    public function paketLab()
    {
        return $this->belongsTo(PaketLab::class, 'id_paket_lab');
    }

    public function kategori_alat_detail()
    {
        return $this->hasMany(KategoriAlatDetail::class, 'id_kode_lab', 'id_kode_lab');
    }
    public function paket_lab_detail()
    {
        return $this->hasMany(PaketLabDetail::class, 'id_kode_lab'); // Sesuaikan dengan  field foreign key
    }
}
