<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterPJ extends Model
{
    use HasFactory;

    protected $table = 'dokter_pj';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
