<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antibiotik extends Model
{
    use HasFactory;

    protected $table = 'antibiotik';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
