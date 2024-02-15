<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'factura'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'fecha',
        'monto',
        'estado',
        'igv',
        'total',
        'descripcion',
        // 'id_paciente',
        // 'consulta_id',
        // 'doctor_id',
        // 'id_pago',
        // 'id_cita'

    ];
}
