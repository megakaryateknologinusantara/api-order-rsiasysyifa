<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LISHasilDetail extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'lab_hasil';
    protected $primaryKey = 'no_order';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}
