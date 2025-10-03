<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeLabDetail extends Model
{
    use HasFactory;

    protected $table = 'kode_lab_detail';
    protected $primaryKey = 'id_kode_lab_detail';
    protected $guarded = [];
}
