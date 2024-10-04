<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Persona, User, Role};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)

    {
        $nom = $request->input('name');
        $rolId = '2';
        $docentes = Persona::whereHas('users.roles', function ($query) use ($rolId, $nom) {
            $query->where('id', $rolId)
                ->where(function ($query) use ($nom) {
                    $query->where('nombre', 'LIKE', "%$nom%")
                        ->orWhere('apellido', 'LIKE', "%$nom%")
                        ->orWhere('documento_identidad', 'LIKE', "%$nom%");
                });
        })->paginate(10);


   //     $personas = Persona::whereIn('id', $docentes->pluck('model_id'))->get();

  return view('docente.index',compact('docentes'));

        // return view('persona.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas=new Persona;
        $roles=new Role;
        $roles=Role::orderBy('id','DESC')->paginate(6);
        $roles = Role::all();
        return view ('docente.create', compact('personas', 'roles'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         // Validar los campos
         $campos = [
             'username' => 'required|string|max:100',
             'password' => 'required|string|min:8',
             'documento_identidad' => 'required|string|max:100',
             'nombre' => 'required|string|max:100',
             'apellido' => 'required|string|max:100',
             'email' => 'required|string|email|max:100|unique:users,email',
             'telefono' => 'required|string|max:100',
         ];

         $mensaje = [
             'required' => 'El :attribute es requerido',
             'email.unique' => 'El email ya está registrado',
         ];

         $this->validate($request, $campos, $mensaje);

         // Crear un nuevo usuario
         $users = new User;
         $users->username = $request->get('username');

         // Encriptar la contraseña
         $users->password = Hash::make($request->get('password'));

         $users->email = $request->get('email');
         $users->save();

         // Crear los datos de la persona asociada
         $personas = new Persona;
         $personas->documento_identidad = $request->get('documento_identidad');
         $personas->nombre = $request->get('nombre');
         $personas->apellido = $request->get('apellido');
         $personas->telefono = $request->get('telefono');
         $personas->id_usuario = $users->id;
         $personas->save();

         // Asignar el rol al usuario
         $role_id = $request->input('role');
         DB::table('model_has_roles')->insert([
             'role_id' => $role_id,
             'model_id' => $users->id,
             'model_type' => 'App\Models\User'
         ]);

         // Redirigir con un mensaje de éxito
         return Redirect::to('docente')->with('mensaje', 'Docente creado exitosamente');
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $roles=new Role;
        $personas=Persona::findOrFail($id);
        $roles=Role::orderBy('id','DESC')->paginate(6);
        $users = User::find($id);
        $roles = Role::all();
        $model_has_roles = $users->roles()->first();
        return view ('docente.edit', compact('personas', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validar los campos
    $campos = [
        'documento_identidad' => 'required|string|max:100',
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users,email,' . $id,
        'telefono' => 'required|string|max:100',
        'password' => 'nullable|string|min:8',  // Solo validar si se pasa una nueva contraseña
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
        'email.unique' => 'El email ya está registrado',
    ];

    $this->validate($request, $campos, $mensaje);

    // Encontrar el usuario y la persona
    $users = User::findOrFail($id);
    $personas = Persona::findOrFail($id);

    // Actualizar los datos de la persona
    $personas->update([
        'documento_identidad' => $request->input('documento_identidad'),
        'nombre' => $request->input('nombre'),
        'apellido' => $request->input('apellido'),
        'telefono' => $request->input('telefono'),
    ]);

    // Actualizar el email
    $users->email = $request->input('email');

    // Si se envió una nueva contraseña, encriptarla y actualizarla
    if (!empty($request->input('password'))) {
        $users->password = Hash::make($request->input('password'));
    }

    // Guardar los cambios
    $users->save();
    $personas->save();

    // Actualizar el rol
    $role_id = $request->input('role');
    DB::table('model_has_roles')
        ->where('model_id', $users->id)
        ->update([
            'role_id' => $role_id,
        ]);

    // Redirigir con un mensaje de éxito
    return Redirect::to('docente')->with('mensaje', 'Docente actualizado exitosamente');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $users=User::findOrFail($id);
        $personas=Persona::findOrFail($id);

        $users->delete();
        $personas->delete();



         return Redirect::to('docente');
    }
}
