<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $faker = \Faker\Factory::create();
        $doctorsCount = 20; // Número de doctores a crear
        
        $doctorRole = 'Doctor'; // El nombre del rol Doctor
        
        // Buscar usuarios con el rol Doctor
        $usersWithDoctorRole = User::whereHas('role', function ($query) use ($doctorRole) {
            $query->where('nombre', $doctorRole); // Filtrar por el nombre del rol Doctor
        })->pluck('id')->toArray(); // Obtener los IDs de los usuarios con el rol Doctor
        
        // Verificar si hay usuarios con el rol Doctor
        if (count($usersWithDoctorRole) > 0) {
            // Iterar para crear los doctores falsos    
            for ($i = 0; $i < $doctorsCount; $i++) {
                // Obtener un usuario aleatorio con el rol Doctor
                $randomUserId = $usersWithDoctorRole[array_rand($usersWithDoctorRole)];
        
                // Crear un doctor usando Faker y el ID del usuario obtenido
                Doctor::create([
                    'dni' => $faker->numerify('########'), // Generar un número de identificación ficticio
                    'nombre' => $faker->firstName, // Generar un nombre ficticio
                    'apellido' => $faker->lastName, // Generar un apellido ficticio
                    'correo' => $faker->email, // Generar un correo electrónico ficticio
                    'direccion' => $faker->address, // Generar una dirección ficticia
                    'colegiatura' => $faker->randomNumber(6), // Generar un número de colegiatura ficticio de 6 dígitos
                    'telefono' => $faker->phoneNumber, // Generar un número de teléfono ficticio
                    'users_id' => $randomUserId, // Asignar el ID del usuario obtenido al nuevo doctor
                ]);
            }
        }


        Doctor::create([
            'dni' => '########',
            'nombre' => 'Doctor',
            'apellido' => 'TV',
            'correo' => 'doctortv@hotmail.com',
            'direccion' => 'Av. Tupac Amaru',
            'colegiatura' => '328247',
            'telefono' => $faker->phoneNumber,
            'users_id' => 2,
        ]);
    }
}
