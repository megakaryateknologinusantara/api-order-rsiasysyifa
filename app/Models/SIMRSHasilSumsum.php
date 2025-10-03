<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIMRSHasilSumsum extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'lab_hasil_sumsum';
    protected $primaryKey = 'no_order_slims';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}
