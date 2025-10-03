<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAsuransi extends Model
{
    use HasFactory;

    protected $table = 'status_asuransi';
    protected $primaryKey = 'id_asuransi';
    protected $guarded = [];
}
