<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterLabel extends Model
{
    use HasFactory;
    protected $table = 'printer';
    protected $primaryKey = 'id_printer';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function userupdate()
    {
        return $this->hasOne(User::class, 'id', 'user_update');
    }
}
