<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();

        $patientsCount = 20;

        $patientRole = 'Paciente'; // El nombre del rol Paciente

        // Buscar usuarios con el rol Paciente
        $usersWithPatientRole = User::whereHas('role', function ($query) use ($patientRole) {
            $query->where('nombre', $patientRole);
        })->pluck('id')->toArray();

        // Verificar si hay usuarios con el rol Paciente
        if (count($usersWithPatientRole) > 0) {
            // Iterar para crear los pacientes falsos
            for ($i = 0; $i < $patientsCount; $i++) {
                // Obtener un usuario aleatorio con el rol Paciente
                $randomUserId = $usersWithPatientRole[array_rand($usersWithPatientRole)];



                Paciente::create([
                    'dni' => $faker->numerify('########'),
                    'nombre' => $faker->firstName,
                    'apellido' => $faker->lastName,
                    'correo' => $faker->email,
                    'direccion' => $faker->address,
                    'telefono' => $faker->phoneNumber,
                    'users_id' => $randomUserId,
                ]);
            }
        }
    }
}
