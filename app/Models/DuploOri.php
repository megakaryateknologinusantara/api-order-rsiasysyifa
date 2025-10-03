<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuploOri extends Model
{
    use HasFactory;

    protected $table = 'duplo_ori';
    protected $primaryKey = 'id_duplo';
    protected $guarded = [];
}
