<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabKulturAntibiotik extends Model
{
    use HasFactory;

    protected $table = 'lab_kultur_antibiotik';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function antibiotik()
    {
        return $this->hasOne(Antibiotik::class, 'id', 'id_antibiotik');
    }
}
