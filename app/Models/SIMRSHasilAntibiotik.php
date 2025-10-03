<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIMRSHasilAntibiotik extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'lab_hasil_antibiotik';
    protected $primaryKey = 'no_registrasi';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}