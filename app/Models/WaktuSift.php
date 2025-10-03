<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuSift extends Model
{
    use HasFactory;

    protected $table = 'waktu_sift';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
