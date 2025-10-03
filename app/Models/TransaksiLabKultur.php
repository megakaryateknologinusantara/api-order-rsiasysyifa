<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabKultur extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_kultur';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function specimen()
    {
        return $this->hasOne(Specimen::class, 'id', 'id_specimen');
    }
}
