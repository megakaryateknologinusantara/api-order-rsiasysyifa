<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAlatKimia extends Model
{
    use HasFactory;

    protected $table = 'order_alat_kimia';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
