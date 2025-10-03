<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabSumsumTulang2 extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_sumsum_tulang2';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kode_lab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }
}
