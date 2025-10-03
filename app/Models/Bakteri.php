<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bakteri extends Model
{
    use HasFactory;

    protected $table = 'bakteri';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
