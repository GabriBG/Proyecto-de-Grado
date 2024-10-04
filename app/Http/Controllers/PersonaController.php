<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Persona, User, Role};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        $nom = $request->input('name');
        $personas = Persona::where('nombre','LIKE',"%$nom%")
            ->orWhere('apellido','LIKE',"%$nom%")
            ->orWhere('documento_identidad','LIKE',"%$nom%")
            ->paginate(8);

        return view('persona.index', compact('personas'));
    }

    public function create()
    {
        $personas = new Persona;
        $roles = Role::all();
        return view('persona.create', compact('personas', 'roles'));
    }

    public function store(Request $request)
    {
        // Validar los campos
        $campos = [
            'username' => 'required|string|max:100',
            'password' => 'required|string|min:8',
            'documento_identidad' => 'required|string|max:100',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido'
        ];

        $this->validate($request, $campos, $mensaje);

        // Crear un nuevo usuario
        $users = new User;
        $personas = new Persona;

        // Asignar los valores a las propiedades del modelo
        $users->username = $request->get('username');
        $users->password = Hash::make($request->get('password')); // Encriptar la contraseña
        $users->email = $request->get('email');

        // Guardar el usuario
        $users->save();

        // Crear los datos de la persona asociada
        $personas->documento_identidad = $request->get('documento_identidad');
        $personas->nombre = $request->get('nombre');
        $personas->apellido = $request->get('apellido');
        $personas->telefono = $request->get('telefono');
        $personas->id_usuario = $users->id;

        // Guardar la persona
        $personas->save();

        // Asignar el rol al usuario
        $role_id = $request->input('role');
        DB::table('model_has_roles')->insert([
            'role_id' => $role_id,
            'model_id' => $users->id,
            'model_type' => 'App\Models\User'
        ]);

        // Redirigir a la página de personas
        return Redirect::to('persona');
    }

    public function edit($id)
    {
        $personas = Persona::findOrFail($id);
        $roles = Role::all();
        $users = User::find($id);
        $model_has_roles = $users->roles()->first();
        return view('persona.edit', compact('personas', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validar los campos
        $campos = [
            'documento_identidad' => 'required|string|max:100',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email',
            'telefono' => 'required|string|max:100',
            'password' => 'nullable|string|min:8'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido'
        ];

        $this->validate($request, $campos, $mensaje);

        // Encontrar los modelos de User y Persona
        $user = User::findOrFail($id);
        $persona = Persona::findOrFail($id);

        // Actualizar los datos de la persona
        $persona->update([
            'documento_identidad' => $request->input('documento_identidad'),
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'telefono' => $request->input('telefono')
        ]);

        // Actualizar el email del usuario
        $user->email = $request->input('email');

        // Si se envió una nueva contraseña, encriptarla y actualizarla
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password')); // Encriptar la nueva contraseña
        }

        // Guardar los cambios en los modelos
        $user->save();
        $persona->save();

        // Actualizar el rol si es necesario
        $role_id = $request->input('role');
        DB::table('model_has_roles')
            ->where('model_id', $user->id)
            ->update(['role_id' => $role_id]);

        return Redirect::to('persona')->with('mensaje', 'Persona actualizada');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $personas = Persona::findOrFail($id);

        $users->delete();
        $personas->delete();

        return Redirect::to('persona');
    }
}
