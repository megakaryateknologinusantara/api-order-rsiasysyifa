<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duplo extends Model
{
    use HasFactory;

    protected $table = 'duplo';
    protected $primaryKey = 'id_duplo';
    protected $guarded = [];

    public function detail()
    {
        return $this->hasOne(DuploDetail::class, 'id_duplo', 'id_duplo');
    }
}
