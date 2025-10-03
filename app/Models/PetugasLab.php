<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasLab extends Model
{
    use HasFactory;

    protected $table = 'petugas_lab';
    protected $primaryKey = 'id_petugas_lab';
    protected $guarded = [];
}
