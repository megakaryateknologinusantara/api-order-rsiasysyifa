<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabDeskripsi extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_deskripsi';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
