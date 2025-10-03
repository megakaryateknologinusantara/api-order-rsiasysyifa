<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrubDetailTest extends Model
{
    use HasFactory;
    protected $table = 'grub_detail_test';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function parameterPemeriksaan()
    {
        return $this->belongsTo(KodeLab::class, 'id_kode_lab'); // Make sure this matches the foreign key
    }
}
