<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'correo',
        'direccion',
        'colegiatura',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'doctor_especialidad', 'doctor_id', 'especialidad_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
