<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenCatatan extends Model
{
    use HasFactory;

    protected $table = 'konten_catatan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kategori()
    {
        return $this->hasOne(KategoriCatatan::class, 'id', 'id_kategori');
    }
}
