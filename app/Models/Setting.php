<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';
    protected $primaryKey = 'id_setting';
    protected $guarded = [];

    public function doketer_pj()
    {
        return $this->hasOne(DokterPJ::class, 'id', 'id_dokter_pj');
    }
}
