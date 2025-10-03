<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKirimSimrs extends Model
{
    use HasFactory;

    protected $table = 'status_kirim_simrs';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
