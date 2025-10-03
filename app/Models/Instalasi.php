<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalasi extends Model
{
    use HasFactory;

    protected $table = 'instalasi';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
