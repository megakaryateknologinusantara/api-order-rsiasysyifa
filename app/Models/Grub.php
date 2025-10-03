<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grub extends Model
{
    use HasFactory;

    protected $table = 'grub';
    protected $primaryKey = 'id_grub';
    protected $guarded = [];
}
