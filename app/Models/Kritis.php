<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kritis extends Model
{
    use HasFactory;

    protected $table = 'kritis';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kode_lab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }
}
