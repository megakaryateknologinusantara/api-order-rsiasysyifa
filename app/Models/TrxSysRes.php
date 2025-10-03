<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxSysRes extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'TRX_SYS_RES';
    protected $primaryKey = 'ONO';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}