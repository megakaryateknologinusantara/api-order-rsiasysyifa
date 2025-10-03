<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BakteriDetail extends Model
{
    use HasFactory;

    protected $table = 'bakteri_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function antibiotik()
    {
        return $this->hasOne(Antibiotik::class, 'id', 'id_antibiotik');
    }
}