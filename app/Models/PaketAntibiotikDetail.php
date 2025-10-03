<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketAntibiotikDetail extends Model
{
    use HasFactory;
    protected $table = 'paket_antibiotik_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function antibiotik()
    {
        return $this->hasOne(Antibiotik::class, 'id', 'id_antibiotik');
    }
}
