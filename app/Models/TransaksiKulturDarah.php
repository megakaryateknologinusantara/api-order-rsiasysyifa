<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKulturDarah extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kultur_darah';
    protected $primaryKey = 'id_transaksi_kultur_darah';
    protected $guarded = [];
}
