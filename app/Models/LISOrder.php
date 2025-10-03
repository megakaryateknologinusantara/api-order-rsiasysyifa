<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LISOrder extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'order_lab';
    protected $primaryKey = 'no_lab';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}
