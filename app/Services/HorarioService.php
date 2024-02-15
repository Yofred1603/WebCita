<?php

namespace App\Services;

use App\Http\Controllers\CitasController;
use App\Interfaces\HorarioServiceInterface;
use App\Models\Cita;
use App\Models\Horario;
use Carbon\Carbon;

class HorarioService implements HorarioServiceInterface
{

    // Método privado para obtener el día de la semana a partir de una fecha dada
    private function getDayFromDate($date)
    {
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;

        // Se ajusta el índice del día para ser compatible con los días de la semana (Lunes = 0, Domingo = 6)
        $dia = ($i == 0 ? 6 : $i - 1);
        return $dia;
    }

    // Verifica si hay disponibilidad para una cita en una fecha y hora específica
    public function isAvailableInternal($date, $doctorId, Carbon $start)
    {
        $exists = Cita::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->where('time', $start->format('H:i:s'))
            ->exists();

        return !$exists;
    }

    // Obtiene los intervalos de tiempo disponibles para una fecha y doctor específicos
    public function getAvailableIntervals($date, $doctorId)
    {
        // Obtiene el horario activo del doctor para el día correspondiente
        $horario = Horario::where('activo', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('doctor_id', $doctorId)
            ->first([
                'morning_start', 'morning_end',
                'afternoon_start', 'afternoon_end'
            ]);

        if (!$horario) {
            return []; // Si no hay horario, devuelve un array vacío
        }

        // Obtiene los intervalos disponibles para la mañana y la tarde
        $morningIntervalos = $this->getIntervalos(
            $horario->morning_start,
            $horario->morning_end,
            $doctorId,
            $date
        );

        $afternoonIntervalos = $this->getIntervalos(
            $horario->afternoon_start,
            $horario->afternoon_end,
            $doctorId,
            $date
        );

        // Organiza los intervalos en un array y los devuelve
        $data = [];
        $data['morning'] =  $morningIntervalos;
        $data['afternoon'] =  $afternoonIntervalos;

        return $data;
    }

    // Genera los intervalos disponibles de 30 minutos entre la hora de inicio y fin
    private function getIntervalos($start, $end,  $doctorId, $date)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos = [];

        while ($start < $end) {
            $intervalo = [];

            // Formatea la hora de inicio y fin para mostrar en el formato 12 horas
            $intervalo['start'] = $start->format('g:i A');

            $start->addMinute(30);
            $intervalo['end'] = $start->format('g:i A');

            // Verifica si el intervalo está disponible y lo agrega al array de intervalos
            $available = $this->isAvailableInternal($date, $doctorId, $start);

            if ($available) {
                $intervalos[] = $intervalo;
            }
        }

        return $intervalos;
    }
}
