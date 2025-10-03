<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiCovid extends Model
{
    use HasFactory;

    protected $table = 'transaksi_covid';
    protected $primaryKey = 'id_transaksi_covid';
    protected $guarded = [];
}
