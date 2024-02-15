<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //
    public function index()
    {
        $usuarios = User::paginate(20);    // Método para mostrar una lista paginada de usuarios
        return view('usuarios.index', compact('usuarios'));
    }

    // Método para mostrar el formulario de creación de usuarios con los roles disponibles
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('usuarios.create', compact('roles'));
    }

    // Método para almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validar los campos enviados en el formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'nullable|exists:role,id',
        ]);

        // Crear un nuevo usuario con la información proporcionada
        $user = User::create($request->all());

        // Asociar el rol al usuario creado
        $role = Role::find($request->input('role_id'));
        $user->role()->associate($role);
        $user->save();

        $notificacion = 'El Medico se ah Registrado Correctamente.';

        return redirect('/usuarios')->with(compact('notificacion'));
    }

    // Método para mostrar la información de un usuario específico
    public function show($id)
    {
        $usuarios = User::findOrFail($id);
        return view('usuarios.show', compact('usuarios'));
    }

    // Método para mostrar el formulario de edición de un usuario con los roles disponibles
    public function edit($id)
    {
        $roles = Role::all();
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    // Método para actualizar la información de un usuario existente
    public function update(Request $request, $id)
    {
        // Validar los campos enviados en el formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'nullable|exists:role,id',
        ]);

        $user = User::findOrFail($id);

        // Actualizar los campos del usuario excepto la contraseña
        $user->fill($request->except('role_id', 'password'));

        // Asociar el nuevo rol al usuario si se proporciona un role_id válido
        if ($request->has('role_id')) {
            $role = Role::find($request->input('role_id'));
            if ($role) {
                $user->role()->associate($role);
            }
        }

        $user->save();

        $notificacion = 'La Informacion del Medico se Actualizo Correctamente.';

        return redirect('/usuarios')->with(compact('notificacion'));
    }

    // Método para eliminar un usuario existente
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/usuarios')->with('success', 'User deleted successfully');
    }

    // Método para mostrar el rol asociado a un usuario específico
    public function showUserRole($userId)
    {
        $user = User::find($userId);
        $role = $user->role; // Esto obtendrá el rol asociado al usuario

        return $role;
    }
}
