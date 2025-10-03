<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPasien extends Model
{
    use HasFactory;

    protected $table = 'kelas_pasien';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
