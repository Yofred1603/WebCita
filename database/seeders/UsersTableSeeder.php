<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Creación de un usuario administrador
        User::create([
            'name' => 'admin',
            'email' => 'administrador@hotmail.com',
            'email_verified_at' => now(), // Marcar el correo como verificado en el momento actual
            'password' => bcrypt('12345678'), // Encriptar la contraseña '12345678'
            'role_id' => 1, // Asignar el rol de administrador (presumiblemente ID 1)
        ]);

        // Creación de un usuario doctor
        User::create([
            'name' => 'doctor',
            'email' => 'doctor1@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role_id' => 3, // Asignar el rol de doctor (presumiblemente ID 3)
        ]);

        // Creación de un usuario paciente
        User::create([
            'name' => 'paciente',
            'email' => 'paciente1@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role_id' => 2, // Asignar el rol de paciente (presumiblemente ID 2)
        ]);

        // Utilización de un Factory para crear 60 usuarios adicionales aleatorios
        User::factory()
            ->count(60) // Crear 60 usuarios
            ->create(); // Utilizar el factory para crear estos usuarios
    }
}
