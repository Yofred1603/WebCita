<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'day',
        'activo',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'doctor_id' 
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
