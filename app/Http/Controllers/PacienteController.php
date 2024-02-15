<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    //
    // Método para mostrar una lista paginada de pacientes
    public function index()
    {
        $pacientes = Paciente::paginate(20);
        return view('pacientes.index', compact('pacientes'));
    }

    // Método para mostrar el formulario de creación de pacientes
    public function create()
    {
        return view('pacientes.create');
    }

    // Método para almacenar un nuevo paciente en la base de datos
    public function store(Request $request)
    {
        // Validar los campos enviados en el formulario
        $request->validate([
            'dni' => 'required|string',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ]);

        // Crear un nuevo paciente con la información proporcionada
        Paciente::create($request->all());

        return redirect('/pacientes')->with('success', 'Paciente creado exitosamente');
    }

    // Método para mostrar el formulario de edición de un paciente específico
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    // Método para actualizar la información de un paciente existente
    public function update(Request $request, Paciente $paciente)
    {
        // Validar los campos enviados en el formulario
        $request->validate([
            'dni' => 'required|string',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ]);

        // Actualizar los campos del paciente con la información proporcionada
        $paciente->update($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente actualizado exitosamente');
    }

    // Método para eliminar un paciente existente
    public function destroy(Paciente $paciente)
    {
        $deleteName = $paciente->nombre; // Guarda el nombre antes de eliminarlo
        $paciente->delete(); // Elimina el paciente de la base de datos
        $notificacion = 'El Paciente ' . $deleteName . ' se ah Eliminado correctamente';

        return redirect('/pacientes')->with(compact('notificacion'));
    }

    
}
