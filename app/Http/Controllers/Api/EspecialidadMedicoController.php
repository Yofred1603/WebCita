<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadMedicoController extends Controller
{
    //

    public function doctores(Especialidad $especialidad)
    {

        // Obtener los doctores asociados a la especialidad proporcionada

        $doctores = $especialidad->doctores()->select('doctores.id', 'doctores.nombre')->get();

         // Retornar los doctores como una respuesta JSON
        return response()->json($doctores);
    }

    // $doctores = $especialidad->doctores()->get([
    //     'id',
    //     'nombre',
    //     // Puedes seleccionar más campos si los necesitas
    // ]);

    // return response()->json($doctores);

    // $doctores = Doctor::where('especialidad_id', $especialidadId)->get(['id', 'nombre']);
    // return response()->json($doctores);
}
