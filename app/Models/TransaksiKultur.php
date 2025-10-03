<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKultur extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kultur';
    protected $primaryKey = 'id_transaksi_kultur';
    protected $guarded = [];
}
