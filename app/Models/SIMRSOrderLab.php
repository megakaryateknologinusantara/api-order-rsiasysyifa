<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIMRSOrderLab extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'TR_LIS';
    protected $primaryKey = 'No_Id';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}
