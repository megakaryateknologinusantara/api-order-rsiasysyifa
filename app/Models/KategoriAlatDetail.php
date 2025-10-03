<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAlatDetail extends Model
{
    use HasFactory;

    protected $table = 'kategori_alat_detail';
    protected $primaryKey = 'id_kategori_alat_detail';
    protected $guarded = [];

    public function kodelab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }

    public function alat()
    {
        return $this->hasOne(KategoriAlat::class, 'id_kategori_alat', 'id_kategori_alat');
    }
    
    public function kategori_alat()
    {
        return $this->hasOne(KategoriAlat::class, 'id_kategori_alat', 'id_kategori_alat');
    }
}
