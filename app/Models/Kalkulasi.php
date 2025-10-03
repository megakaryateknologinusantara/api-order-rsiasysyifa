<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalkulasi extends Model
{
    use HasFactory;
    protected $table = 'kalkulasi';
    protected $primaryKey = 'id_kalkulasi';
    protected $guarded = [];

    public function kodeLab()
    {
        return $this->belongsTo(KodeLab::class, 'kode_kalkulasi', 'id_kode_lab');
    }
}
