<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabKlinis extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_klinis';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function ket_klinis()
    {
        return $this->hasOne(KetKlinis::class, 'id', 'id_ket_klinis');
    }
}
