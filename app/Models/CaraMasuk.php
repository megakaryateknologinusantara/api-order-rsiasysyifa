<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaraMasuk extends Model
{
    use HasFactory;

    protected $table = 'cara_masuk';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(TransaksiLab::class, 'id_cara_masuk');
    }
}