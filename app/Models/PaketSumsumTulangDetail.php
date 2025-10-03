<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSumsumTulangDetail extends Model
{
    use HasFactory;

    protected $table = 'paket_sumsum_tulang_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kode_lab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }
}
