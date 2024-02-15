<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Rutas Especialidades
Route::prefix('especialidades')->group(function () {
    // Ruta para mostrar todas las especialidades
    Route::get('/', [App\Http\Controllers\EspecialidadController::class, 'index']);

    // Ruta para mostrar el formulario de creación de una nueva especialidad
    Route::get('/create', [App\Http\Controllers\EspecialidadController::class, 'create']);

    // Ruta para almacenar una nueva especialidad en la base de datos
    Route::post('/', [App\Http\Controllers\EspecialidadController::class, 'store']);

    // Ruta para mostrar el formulario de edición de una especialidad específica
    Route::get('/{especialidad}/edit', [App\Http\Controllers\EspecialidadController::class, 'edit']);

    // Ruta para actualizar una especialidad específica en la base de datos
    Route::put('/{especialidad}', [App\Http\Controllers\EspecialidadController::class, 'update']);

    // Ruta para eliminar una especialidad específica de la base de datos
    Route::delete('/{especialidad}', [App\Http\Controllers\EspecialidadController::class, 'destroy']);
});



//Rutas Medicos
Route::prefix('medicos')->group(function () {
    Route::get('/', [App\Http\Controllers\DoctorController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\DoctorController::class, 'create']);
    Route::post('/', [App\Http\Controllers\DoctorController::class, 'store']);
    Route::get('/{medico}/edit', [App\Http\Controllers\DoctorController::class, 'edit']);
    Route::put('/{medico}', [App\Http\Controllers\DoctorController::class, 'update']);
    Route::delete('/{medico}', [App\Http\Controllers\DoctorController::class, 'destroy']);
});

//Rutas Pacientes
Route::prefix('pacientes')->group(function () {
    Route::get('/', [App\Http\Controllers\PacienteController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\PacienteController::class, 'create']);
    Route::post('/', [App\Http\Controllers\PacienteController::class, 'store']);
    Route::get('/{paciente}/edit', [App\Http\Controllers\PacienteController::class, 'edit']);
    Route::put('/{paciente}', [App\Http\Controllers\PacienteController::class, 'update']);
    Route::delete('/{paciente}', [App\Http\Controllers\PacienteController::class, 'destroy']);
});

//Rutas Usuarios
Route::prefix('usuarios')->group(function () {
    Route::get('/', [App\Http\Controllers\UsuarioController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\UsuarioController::class, 'create']);
    Route::post('/', [App\Http\Controllers\UsuarioController::class, 'store']);
    Route::get('/{usuario}/edit', [App\Http\Controllers\UsuarioController::class, 'edit']);
    Route::put('/{usuario}', [App\Http\Controllers\UsuarioController::class, 'update']);
    Route::delete('/{usuario}', [App\Http\Controllers\UsuarioController::class, 'destroy']); 
});


//Rutas Horario
Route::get('/horario', [App\Http\Controllers\HorarioController::class, 'edit']);
Route::post('/horario', [App\Http\Controllers\HorarioController::class, 'store']);


//Rutas para Citas
Route::get('/reservacitas/create', [App\Http\Controllers\CitasController::class, 'create']);
Route::post('/reservacitas', [App\Http\Controllers\CitasController::class, 'store']);
Route::get('/miscitas', [App\Http\Controllers\CitasController::class, 'index']);
Route::post('/miscitas/{cita}/cancel', [App\Http\Controllers\CitasController::class, 'cancel']);
Route::get('/miscitas/{cita}/cancel', [App\Http\Controllers\CitasController::class, 'cancelarFormulario']);


Route::get('doctores/{doctorId}/horarios', [CitasController::class, 'horariosPorDoctorYFecha']);
Route::get('/doctores/{doctorId}/horarios/{fecha}', [App\Http\Controllers\CitasController::class, 'horariosPorDoctorYFecha']);
Route::get('/horarios/{fecha}', [App\Http\Controllers\CitasController::class, 'horariosPorFecha']);

// Rutas JSON
Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'horas']);
Route::get('/especialidades/{especialidad}/doctores', [App\Http\Controllers\Api\EspecialidadMedicoController::class, 'doctores']);
Route::get('/doctores/{doctorId}/horarios/{fecha}', [App\Http\Controllers\CitasController::class, 'horariosPorDoctorYFecha']);


//Ruta para perfil
Route::get('/profile', [App\Http\Controllers\UsuarioController::class, 'edit']);
Route::post('/profile', [App\Http\Controllers\UsuarioController::class, 'update']);

Route::get('/user/{userId}/role', [App\Http\Controllers\UserController::class, 'showUserRole']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
