<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriCatatan extends Model
{
    use HasFactory;

    protected $table = 'kategori_catatan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
