<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    public function transaksiLab()
    {
        return $this->belongsTo(TransaksiLab::class, 'id_transaksi_lab');
    }
    

}
