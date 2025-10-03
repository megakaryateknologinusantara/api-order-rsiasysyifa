<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrubTest extends Model
{
    use HasFactory;

    protected $table = 'grub_test';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function grubDetails()
    {
        return $this->hasMany(GrubDetailTest::class);
    }

    // Adding the relationship to 'ParameterPemeriksaan'
    public function parameterPemeriksaan()
    {
        return $this->hasManyThrough(KodeLab::class, GrubDetail::class);
    }

    public function grub1Name()
    {
        return $this->belongsTo(ParameterGrub::class, 'grub1');
    }
    public function grub2Name()
    {
        return $this->belongsTo(ParameterGrub::class, 'grub2');
    }
    public function grub3Name()
    {
        return $this->belongsTo(ParameterGrub::class, 'grub3');
    }
}
