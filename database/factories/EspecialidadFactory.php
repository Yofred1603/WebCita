<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidad;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especialidad>
 */
class EspecialidadFactory extends Factory
{
     // Establece el modelo asociado con el Factory
    protected $model = Especialidad::class;

    public function definition(): array
    {
        // Define la estructura de datos para la creación de especialidades médicas
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Cardiología',
                'Dermatología',
                'Pediatría',
                'Ginecología',
                'Medicina Interna',
                'Psiquiatría',
                'Gastroenterología',
                'Neurología',
                'Radiología'
            ]),
        ];
    }
}
