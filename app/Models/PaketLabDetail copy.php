<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLabDetail extends Model
{
    use HasFactory;

    protected $table = 'paket_lab_detail';
    protected $primaryKey = 'id_paket_lab_detail';
    protected $guarded = [];

    public function kodelab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    public function paketLab()
    {
        return $this->hasOne(PaketLab::class, 'id_paket_lab');
    }
}
