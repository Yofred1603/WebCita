<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Llama al seeder para poblar la tabla de roles con datos predeterminados.
        $this->call(RoleTableSeeder::class);

        // Llama al seeder para poblar la tabla de usuarios con datos predeterminados.
        $this->call(UsersTableSeeder::class);

        // Llama al seeder para poblar la tabla de doctores con datos predeterminados.
        $this->call(DoctoresTableSeeder::class);

        // Llama al seeder para poblar la tabla de pacientes con datos predeterminados.
        $this->call(PacientesTableSeeder::class);

        // Llama al seeder para poblar la tabla de especialidades con datos predeterminados.
        $this->call(EspecialidadesTableSeeder::class);

        $this->call(DoctorEspecialidadSeeder::class);

        $this->call(HorariosSeeder::class);
    }
}
