<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // Nombre de la tabla en la base de datos

    protected $fillable =[
        'nombre'
    ];

       // Relación: Un rol puede tener varios usuarios
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
