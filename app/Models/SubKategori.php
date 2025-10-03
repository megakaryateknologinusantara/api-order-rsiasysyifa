<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';
    protected $primaryKey = 'id_sub_kategori';
    protected $guarded = [];

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
