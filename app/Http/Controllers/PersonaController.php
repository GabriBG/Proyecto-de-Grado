<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Persona, User, Role};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $roles=new Role;
       $nom = $request->input('name');

        $personas = Persona::where('nombre','LIKE',"%$nom%")->
        orWhere('apellido','LIKE',"%$nom%")->
        orWhere('documento_identidad','LIKE',"%$nom%")->paginate(8);

  return view('persona.index',compact('personas', 'roles'));

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
        return view ('persona.create', compact('personas', 'roles'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

            $campos=[
                'username'=>'required|string|max:100',
                'password'=>'required|string|max:100',
                'documento_identidad'=>'required|string|max:100',
                'nombre'=>'required|string|max:100',
                'apellido'=>'required|string|max:100',
                'email'=>'required|string|max:100',
                'telefono'=>'required|string|max:100',
            ];

            $mensaje=[
                'required'=>'El :attribute es requerido'
            ];

            $this->validate($request, $campos,$mensaje);

        $users=new User;
        $personas=new Persona;
        $users->username=$request->get('username');
        $users->password=$request->get('password');
        $users->email=$request->get('email');

        $users->save();

        $personas->documento_identidad=$request->get('documento_identidad');
        $personas->nombre=$request->get('nombre');
        $personas->apellido=$request->get('apellido');
        $personas->telefono=$request->get('telefono');
        $personas->id_usuario=$users->id;

        $personas->save();

        $role_id = $request->input('role');

        DB::table('model_has_roles')
        ->insert([
            'role_id' => $role_id,
            'model_id' => $users->id,
            'model_type' => 'App\Models\User']);


        return Redirect::to('persona');
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
        return view ('persona.edit', compact('personas', 'roles'));
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

        $campos=[
            'documento_identidad'=>'required|string|max:100',
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'email'=>'required|email',
            'telefono'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $users=new User;
        $users=User::findOrFail($id);
        $personas=Persona::findOrFail($id);
        $personas->update([
        'documento_identidad'=>$request->input('documento_identidad'),
        'nombre'=>$request->input('nombre'),
        'apellido'=>$request->input('apellido'),
        'telefono'=>$request->input('telefono')]);
        $users->email=$request->input('email');


        $role_id = $request->input('role');

        DB::table('model_has_roles')->where('model_id', $users->id)
        ->update([
            'role_id' => $role_id,
            'model_id' => $users->id,
            'model_type' => 'App\Models\User']);

        $personas->save();
        $users->save();

        return Redirect::to('persona')->with('mensaje','Persona Actualizada');
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



         return Redirect::to('persona');
    }
}
