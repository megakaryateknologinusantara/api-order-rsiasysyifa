<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabSumsumTulang1 extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_sumsum_tulang1';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // public function titel()
    // {
    //     return $this->hasOne(KodeLab::class, 'id', 'id_titel');
    // }
}
