<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSumsumTulang extends Model
{
    use HasFactory;

    protected $table = 'paket_sumsum_tulang';
    protected $primaryKey = 'id';
    protected $guarded = [];
}