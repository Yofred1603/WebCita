<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear roles predeterminados en la base de datos
        Role::create([
            'nombre' => 'Admin', // Rol de administrador
        ]);

        Role::create([
            'nombre' => 'Paciente', // Rol de paciente
        ]);
        
        Role::create([
            'nombre' => 'Doctor', // Rol de doctor
        ]);
    }
}
