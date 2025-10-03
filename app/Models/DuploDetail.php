<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuploDetail extends Model
{
    use HasFactory;

    protected $table = 'duplo_detail';
    protected $primaryKey = 'id_duplo_detail';
    protected $guarded = [];

    public function duplo()
    {
        return $this->hasOne(Duplo::class, 'id_duplo', 'id_duplo');
    }
}
