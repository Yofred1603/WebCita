<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Especialidad::factory()->count(9)->create();
    }

    
}
