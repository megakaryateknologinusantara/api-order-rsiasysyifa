<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritisDetail extends Model
{
    use HasFactory;

    protected $table = 'kritis_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
