<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), // Genera un nombre aleatorio
            'email' => $this->faker->unique()->safeEmail(), // Genera un correo electrónico único y seguro
            'email_verified_at' => now(), // Marca el correo como verificado en el momento actual
            'password' => Str::random(9), // Genera una contraseña aleatoria de 9 caracteres
            'remember_token' => Str::random(10), // Genera un token aleatorio para recordar la sesión
            'role_id' => $this->faker->randomElement([2, 3]), // Asigna un ID de rol aleatorio (2 o 3)
        
        ];

        
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
