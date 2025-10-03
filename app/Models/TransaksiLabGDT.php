<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabGDT extends Model
{
    use HasFactory;
    protected $table = 'transaksi_lab_gdt';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function transaksi_lab()
    {
        return $this->hasOne(TransaksiLab::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }
}
