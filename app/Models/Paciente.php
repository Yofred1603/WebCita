<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'dni',
        'nombre',
        'apellido', 
        'correo',
        'direccion',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
