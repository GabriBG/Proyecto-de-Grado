<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Asignacion_Grupo, Persona, Asignatura, Grupo};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class AsignacionGrupoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index(Request $request)
     {
        $nom = $request->input('name');

        $asignacion_grupos = Asignacion_Grupo::whereHas('personas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%")
                  ->orWhere('apellido', 'LIKE', "%$nom%");
        })->orWhereHas('asignaturas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%");
        })->orWhereHas('grupos', function ($query) use ($nom) {
            $query->where('numero_grupo', 'LIKE', "%$nom%");
        })->with('personas', 'asignaturas', 'grupos')->get();

        return view('asignaciongrupo.index',compact('asignacion_grupos'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {

        $personas = DB::table('personas')
        ->join('model_has_roles', 'personas.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'docente')
        ->select('personas.*')
        ->get();

        $asignacion_grupos = Asignacion_Grupo::orderBy('id','DESC')->paginate(6);
         $asignaturas = Asignatura::orderBy('id','DESC')->paginate(6);
         $grupos = Grupo::orderBy('id','DESC')->paginate(6);
         return view ('asignaciongrupo.create', compact('personas', 'asignaturas', 'grupos', 'asignacion_grupos'));
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
                 'docente'=>'required|string|max:100',
                 'asignatura'=>'required|string|max:100',
                 'grupo'=>'required|string|max:100',
             ];

             $mensaje=[
                 'required'=>'El :attribute es requerido'
             ];

             $this->validate($request, $campos,$mensaje);

         $asignaciones=new Asignacion_Grupo();
         $asignaciones->grupo_id=$request->get('grupo');
         $asignaciones->asignatura_id=$request->get('asignatura');
         $asignaciones->persona_id=$request->get('docente');

         $asignaciones->save();

         return Redirect::to('asignaciongrupo');
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
