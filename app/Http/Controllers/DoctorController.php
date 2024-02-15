<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //
    // Método para mostrar todos los doctores paginados
    public function index()
    {
        $doctores = Doctor::paginate(20);
        return view('doctores.index', compact('doctores'));
    }

    // Método para mostrar el formulario de creación de doctores
    public function create(Doctor $doctor)
    {
        // Obtener todas las especialidades
        $especialidades = Especialidad::all();
        // Obtener las especialidades asociadas al doctor (en caso de edición)
        $especialidades_ids = $doctor->especialidades()->pluck('especialidades.id');
        return view('doctores.create', compact('doctor', 'especialidades', 'especialidades_ids'));
    }

    public function store(Request $request)
    {
        // Reglas de validación y mensajes personalizados
        $rules = ([
            'dni' => 'required|string',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'colegiatura' => 'required|string',
            'telefono' => 'required|string',
        ]);

        $messages = [
            'name.required' => 'El nombre del Medico es Obligatorio',
            'name.min' => 'El nombre del Medico debe tener minimo 10 caracteres',
            'email.required' => 'El Correo Electronico es Obligatorio',
            'email.email' => 'Ingresa un correo electronico valido',
            'dni.required' => 'El DNI es Obligatorio',
            'dni.digits' => 'El DNI debe tener minimo 10 caracteres',
            'direccion.required' => 'La direccion es Obligatoria',
            'telefono.required' => 'El Telefono es Obligatorio',
            'telefono.min' => 'El Telefono debe tener minimo 9 caracteres'


        ];

        // Validar los datos del formulario
        $this->validate($request, $rules, $messages);

        // Crear un nuevo doctor con los datos proporcionados
        $doctor = Doctor::create($request->except('especialidades'));

        // Obtener las especialidades seleccionadas del formulario
        $especialidades = $request->input('especialidades', []);

        // Asociar las especialidades al doctor recién creado
        $doctor->especialidades()->attach($especialidades);

        $notificacion = 'El Médico se ha registrado correctamente.';

        return redirect('/medicos')->with(compact('notificacion'));
    }

    public function edit(string $id)
    {
        // Obtener el doctor por su ID
        $doctor = Doctor::findOrFail($id);
        // Obtener todas las especialidades
        $especialidades = Especialidad::all();
        // Obtener las especialidades asociadas al doctor (en caso de edición)
        $especialidades_ids = $doctor->especialidades()->pluck('especialidades.id');
        return view('doctores.edit', compact('doctor', 'especialidades', 'especialidades_ids'));
    }
    

    public function update(Request $request, $id)
    {
        $rules = ([
            'dni' => 'required|string',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'colegiatura' => 'required|string',
            'telefono' => 'required|string',
        ]);

        $messages = [
            'name.required' => 'El nombre del Medico es Obligatorio',
            'name.min' => 'El nombre del Medico debe tener minimo 10 caracteres',
            'email.required' => 'El Correo Electronico es Obligatorio',
            'email.email' => 'Ingresa un correo electronico valido',
            'dni.required' => 'El DNI es Obligatorio',
            'dni.digits' => 'El DNI debe tener minimo 10 caracteres',
            'direccion.required' => 'La direccion es Obligatoria',
            'telefono.required' => 'El Telefono es Obligatorio',
            'telefono.min' => 'El Telefono debe tener minimo 9 caracteres'


        ];
        // Validar los datos del formulario
        $this->validate($request, $rules, $messages);

        // Obtener el doctor por su ID
        $doctor = Doctor::findOrFail($id);

        // Actualizar los campos del doctor con los datos del formulario
        $doctor->update($request->except('especialidades'));

        // Obtener las especialidades seleccionadas del formulario
        $especialidades = $request->input('especialidades', []);

        // Sincronizar las especialidades del doctor con las seleccionadas en el formulario
        $doctor->especialidades()->sync($especialidades);

        $notificacion = 'La información del Médico se ha actualizado correctamente.';

        return redirect('/medicos')->with(compact('notificacion'));
    }

    public function destroy(Doctor $doctor, $id)
    {
        // Obtener el doctor por su ID
        $doctor = Doctor::findOrFail($id);
        $doctorName = $doctor->nombre;
        $doctor->delete();

        $notificacion = " El Medico $doctorName se Eliminado Correctamente";

       return redirect('/medicos')->with(compact('notificacion'));
    }
}
