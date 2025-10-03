<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterGrub extends Model
{
    use HasFactory;

    protected $table = 'parameter_grub';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
