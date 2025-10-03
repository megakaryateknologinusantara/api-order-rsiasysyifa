<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterLabelDetail extends Model
{
    use HasFactory;

    protected $table = 'printer_detail';
    protected $primaryKey = 'id_printer_detail';
    protected $guarded = [];

    public function printer()
    {
        return $this->hasOne(PrinterLabel::class, 'id_printer', 'id_printer');
    }
}
