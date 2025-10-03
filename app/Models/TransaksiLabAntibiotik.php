<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabAntibiotik extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_antibiotik';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function antibiotik()
    {
        return $this->hasOne(Antibiotik::class, 'id', 'id_antibiotik');
    }
}
