<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIMRSHasil extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'lab_hasil';
    protected $primaryKey = 'no_registrasi';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}