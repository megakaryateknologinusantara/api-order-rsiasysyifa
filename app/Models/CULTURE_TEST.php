<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CULTURE_TEST extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'CULTURE_TEST';
    protected $primaryKey = 'ONO';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}