<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $doctores = Doctor::all();

        foreach ($doctores as $doctor) {
            $existingDays = []; // Array para rastrear los días ya asignados

            // Generar horarios aleatorios para el doctor
            for ($i = 0; $i < 7; $i++) {
                $dayOfWeek = rand(0, 6); // Rango correcto de 0 a 6

                // Verificar si el día ya ha sido asignado para este doctor
                while (in_array($dayOfWeek, $existingDays)) {
                    $dayOfWeek = rand(0, 6); // Generar otro día si ya está asignado
                }

                // Agregar el día actual a los días ya asignados
                $existingDays[] = $dayOfWeek;

                // Crear el horario solo si no existe para ese día y doctor
                if (!Horario::where('day', $dayOfWeek)->where('doctor_id', $doctor->id)->exists()) {
                    Horario::create([
                        'day' => $dayOfWeek,
                        'activo' => rand(0, 1),
                        'morning_start' => '08:00',
                        'morning_end' => '12:00',
                        'afternoon_start' => '14:00',
                        'afternoon_end' => '18:00',
                        'doctor_id' => $doctor->id,
                    ]);
                }
            }
        }
    }
}
