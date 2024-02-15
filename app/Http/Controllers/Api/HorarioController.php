<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\HorarioServiceInterface;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Horarios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    //

    // Método para obtener los horarios disponibles de un médico en una fecha específica
    public function horas(Request $request, HorarioServiceInterface $horarioServiceInterface)
    {
        $rules  = [
            'date' => 'required|date_format:Y-m-d',
            'doctor_id' => 'required|exists:doctores,id'
        ];

        $this->validate($request, $rules);

    
    
        $date = $request->input('date');
        
        $doctorId = $request->input('doctor_id');

        return $horarioServiceInterface->getAvailableIntervals($date,$doctorId);

    }
    

  
   

    
}
