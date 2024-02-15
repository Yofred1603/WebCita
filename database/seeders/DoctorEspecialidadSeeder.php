<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorEspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $doctores = Doctor::all();

        $especialidades = Especialidad::all();

        // Asignar tres especialidades aleatorias a cada doctor
        $doctores->each(function ($doctor) use ($especialidades) {
            $especialidadesAleatorias = $especialidades->random(3);

            $doctor->especialidades()->attach($especialidadesAleatorias);
        });
    }
}
