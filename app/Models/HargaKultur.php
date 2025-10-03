<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaKultur extends Model
{
    use HasFactory;
    
    protected $table = 'harga_kultur';
    protected $primaryKey = 'id_harga_kultur';
    protected $guarded = [];
}
