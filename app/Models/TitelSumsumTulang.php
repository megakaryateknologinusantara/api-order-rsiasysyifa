<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitelSumsumTulang extends Model
{
    use HasFactory;

    protected $table = 'titel_sumsum_tulang';
    protected $primaryKey = 'id';
    protected $guarded = [];
}