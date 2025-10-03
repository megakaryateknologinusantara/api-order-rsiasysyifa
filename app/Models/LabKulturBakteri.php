<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabKulturBakteri extends Model
{
    use HasFactory;

    protected $table = 'lab_kultur_bakteri';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function bakteri()
    {
        return $this->hasOne(Bakteri::class, 'id', 'id_bakteri');
    }
}
