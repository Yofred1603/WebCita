<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre',
        'descripcion'
    ];


    // Define la relación muchos a muchos con el modelo Doctor
    public function doctores()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_especialidad', 'especialidad_id', 'doctor_id');
    }
}
