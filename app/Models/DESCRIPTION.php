<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DESCRIPTION extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'DESCRIPTION';
    protected $primaryKey = 'ONO';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}