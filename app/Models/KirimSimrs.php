<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KirimSimrs extends Model
{
    use HasFactory;
    
    protected $table = 'kirim_simrs';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
