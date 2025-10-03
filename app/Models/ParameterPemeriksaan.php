<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterPemeriksaan extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'kode_lab';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
