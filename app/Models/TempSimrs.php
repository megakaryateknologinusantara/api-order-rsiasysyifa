<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSimrs extends Model
{
    use HasFactory;

    protected $table = 'temp_simrs';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'kode_rm', 'No_MR');
    }

    public function paket_lab()
    {
        return $this->hasOne(PaketLab::class, 'kode_his', 'kode_hasil');
    }
}

