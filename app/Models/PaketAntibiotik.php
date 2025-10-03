<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketAntibiotik extends Model
{
    use HasFactory;
    protected $table = 'paket_antibiotik';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
