<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'date',
        'time',
        'descripcion',
        'tipo',
        'doctor_id',
        'paciente_id',
        'especialidad_id',
    
    ];

    public function especialidad(){
        return $this->belongsTo(Especialidad::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function getScheduledTime12Attribute(){
        return (new Carbon($this->time))
        ->format('g:i A');
    }

    public function cancelacion(){
        return $this->hasOne(CancelarCita::class);
    }
}
