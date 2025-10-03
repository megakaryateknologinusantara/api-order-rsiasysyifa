<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LISOrderDetail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_his';
    protected $table = 'detail_permintaan_lab';
    protected $primaryKey = 'noorder';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}
