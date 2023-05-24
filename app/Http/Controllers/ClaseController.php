<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Asignacion_Grupo, Clase, Horaro, Aula, Persona, Asignatura, Grupo};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ClaseController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index(Request $request)
     {
        $nom = $request->input('name');

        $clases = Clase::with('asignacionGrupos', 'personas', 'asignaturas', 'grupos', 'horarios')->get();


        return view('clase.index',compact('clases'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
        $asignacionGrupos = Asignacion_Grupo::all();

         return view ('clase.create', compact('asignacionGrupos'));
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

         return Redirect::to('clase');
     }

     public function getAsignacionGrupo($id)
     {
         $asignacionGrupo = Asignacion_Grupo::findOrFail($id);
         $persona = Persona::findOrFail($asignacionGrupo->persona_id)->nombre;
         $asignatura = Asignatura::findOrFail($asignacionGrupo->asignatura_id)->nombre;
         $grupo = Grupo::findOrFail($asignacionGrupo->grupo_id)->nombre;

         return response()->json([
             'persona' => $persona,
             'asignatura' => $asignatura,
             'grupo' => $grupo
         ]);
     }
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
         return view ('clase.edit', compact('personas', 'roles'));
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

         return Redirect::to('clase')->with('mensaje','Persona Actualizada');
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



          return Redirect::to('clase');
     }
}
