<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrubDetail extends Model
{
    use HasFactory;

    protected $table = 'grub_detail';
    protected $primaryKey = 'id_grub_detail';
    protected $guarded = [];

    public function kodelab()
    {
        return $this->hasOne(KodeLab::class, 'id_kode_lab', 'id_kode_lab');
    }

    public function grub()
    {
        return $this->hasOne(Grub::class, 'id_grub', 'id_grub');
    }
}
