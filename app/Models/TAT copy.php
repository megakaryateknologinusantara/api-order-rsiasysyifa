<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAT extends Model
{
    use HasFactory;

    protected $table = 'tat';
    protected $primaryKey = 'id_tat';
    protected $guarded = [];

    public function transaksi_lab()
    {
        return $this->hasOne(TransaksiLab::class, 'id_transaksi_lab', 'id_transaksi_lab');
    }
}
