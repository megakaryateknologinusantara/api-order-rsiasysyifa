<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kultur extends Model
{
    use HasFactory;

    protected $table = 'kultur';
    protected $primaryKey = 'id_kultur';
    protected $guarded = [];
}
