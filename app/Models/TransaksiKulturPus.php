<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKulturPus extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kultur_pus';
    protected $primaryKey = 'id_transaksi_kultur_pus';
    protected $guarded = [];
}
