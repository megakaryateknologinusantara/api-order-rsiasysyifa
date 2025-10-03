<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKulturSperma extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kultur_sperma';
    protected $primaryKey = 'id_transaksi_kultur_sperma';
    protected $guarded = [];
}
