<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    //
     // Método para mostrar todas las especialidades
     public function index()
     {
         $especialidades = Especialidad::all();
         return view('especialidades.index', compact('especialidades'));
     }
 
     // Método para mostrar el formulario de creación de especialidades
     public function create()
     {
         return view('especialidades.create');
     }
 
     // Método para guardar una nueva especialidad en la base de datos
     public function store(Request $request)
     {
         // Reglas de validación
         $rules = [
             'nombre' => 'required|min:3',
             'descripcion' => 'nullable',
         ];
         
         // Mensajes de error personalizados
         $messages = [
             'nombre.required' => 'El nombre de la especialidad es obligatorio.',
             'nombre.min' => 'La especialidad debe tener más de 3 caracteres.'
         ];
         
         // Validar los datos del formulario
         $this->validate($request, $rules, $messages);
 
         // Crear una nueva especialidad con los datos proporcionados
         Especialidad::create($request->all());
         $notificacion = 'La especialidad se ha creado correctamente';
 
         return redirect('/especialidades')->with(compact('notificacion'));
     }
 
     // Método para mostrar el formulario de edición de una especialidad
     public function edit(Especialidad $especialidad)
     {
         return view('especialidades.edit', compact('especialidad'));
     }
 
     // Método para actualizar una especialidad existente en la base de datos
     public function update(Request $request, Especialidad $especialidad)
     {
         // Reglas de validación
         $rules = [
             'nombre' => 'required|string',
             'descripcion' => 'nullable|string',
         ];
 
         // Mensajes de error personalizados
         $messages = [
             'nombre.required' => 'El nombre de la especialidad es obligatorio.',
             'nombre.min' => 'La especialidad debe tener más de 3 caracteres.'
         ];
 
         // Validar los datos del formulario
         $this->validate($request, $rules, $messages);
 
         // Actualizar la especialidad con los datos proporcionados
         $especialidad->update($request->all());
         $notificacion = 'La especialidad se ha actualizado correctamente';
 
         return redirect('/especialidades')->with(compact('notificacion'));
     }
 
     // Método para eliminar una especialidad
     public function destroy(Especialidad $especialidad)
     {
         $deleteName = $especialidad->nombre;
         $especialidad->delete();
         $notificacion = 'La especialidad '.$deleteName.' se ha eliminado correctamente';
         return redirect('/especialidades')->with(compact('notificacion'));
     }
 
     // Método para obtener los doctores asociados a una especialidad específica
     public function doctores(Especialidad $especialidad)
     {
         return $especialidad->users()->get([
             'users.id',
             'users.name'
         ]);
     }
}
