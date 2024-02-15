<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    //
    
    // Días de la semana
    private $dias = [
        'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
    ];

    // Método para mostrar y editar el horario del doctor
    public function edit()
    {
        // Obtener los horarios del doctor autenticado
        $horarios = Horario::where('doctor_id', auth()->id())->get();

        // Formatear los horarios si existen registros
        if (count($horarios) > 0) {
            $horarios->map(function ($horario) {
                // Formatear las horas usando Carbon para mostrarlas en un formato legible
                $horario->morning_start = (new Carbon($horario->morning_start))->format('g:i A');
                $horario->morning_end = (new Carbon($horario->morning_end))->format('g:i A');
                $horario->afternoon_start = (new Carbon($horario->afternoon_start))->format('g:i A');
                $horario->afternoon_end = (new Carbon($horario->afternoon_end))->format('g:i A');
            });
        } else {
            // Si no hay horarios, crear una colección vacía
            $horarios = collect();
            // Crear horarios por defecto para los 7 días de la semana
            for ($i = 0; $i < 7; ++$i)
                $horarios->push(new Horario());
        }

          // Ver formato Array que se envie con AM y PM a la bd
        //   dd($horarios->toArray());

        $dias = $this->dias; // Obtener los días de la semana

        return view('horario', compact('dias', 'horarios'));
    }

    // Método para guardar los cambios en el horario del doctor
    public function store(Request $request)
    {
        // Obtener datos del formulario
        $activos = $request->input('activo') ?: [];
        $morning_start = $request->input('morning_start', []);
        $morning_end = $request->input('morning_end', []);
        $afternoon_start = $request->input('afternoon_start', []);
        $afternoon_end = $request->input('afternoon_end', []);

        $errores = []; // Almacenar errores encontrados durante la validación

        // Validar y guardar los horarios para cada día de la semana
        for ($i = 0; $i < 7; ++$i) {
            if ($morning_start[$i] > $morning_end[$i]) {
                $errores[] = 'El intervalo de las horas del turno de la mañana del día ' . $this->dias[$i] . '.';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errores[] = 'El intervalo de las horas del turno de la tarde del día ' . $this->dias[$i] . '.';
            }

            // Actualizar o crear un horario para el día actual
            Horario::updateOrCreate(
                [
                    'day' => $i,
                    'doctor_id' => auth()->id()
                ],
                [
                    'activo' => in_array($i, $activos) ? 1 : 0,
                    'morning_start' => $morning_start[$i] ?? now(),
                    'morning_end' => $morning_end[$i] ?? now(),
                    'afternoon_start' => $afternoon_start[$i] ?? now(),
                    'afternoon_end' => $afternoon_end[$i] ?? now(),
                ]
            );
        }

        // Si hay errores, redirigir con los mensajes de error
        if (count($errores) > 0) {
            return back()->with(compact('errores'));
        }

        // Si se guardan los cambios correctamente, mostrar una notificación
        $notificacion = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notificacion'));
    }
    
}
