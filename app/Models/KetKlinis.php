<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetKlinis extends Model
{
    use HasFactory;
    
    protected $table = 'ket_klinis';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
