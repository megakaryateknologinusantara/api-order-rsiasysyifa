<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIMRSHasilKultur extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'lab_hasil_kultur';
    protected $primaryKey = 'no_order_slims';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}