<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specimen extends Model
{
    use HasFactory;

    protected $table = 'specimen';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
