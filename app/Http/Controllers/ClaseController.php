<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\{Asignacion_Grupo, Clase, Horaro, Aula, Persona, Asignatura, Grupo, Horario};
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


        $clases = Clase::whereHas('horarios', function ($query) use ($nom) {
            $query->where('hora_inicio', 'like', "%$nom%")
                ->orWhere('hora_final', 'LIKE', "%$nom%");
        })->orWhereHas('aulas', function ($query) use ($nom) {
            $query->where('nomenclatura', 'like', "%$nom%");
        })->orWhereHas('asignaturas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%");
        })->orWhereHas('grupos', function ($query) use ($nom) {
            $query->where('numero_grupo', 'LIKE', "%$nom%");
        })->orWhereHas('personas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%")
                ->orWhere('apellido', 'LIKE', "%$nom%");
        })->with('personas', 'asignaturas', 'grupos', 'horarios', 'aulas', 'asignacionGrupos')->get();

        return view('clase.index', compact('clases'));

     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
        $asignacionGrupos = Asignacion_Grupo::all();
        $horarios = Horario::all();
        $aulas = Aula::orderBy('id','DESC')->get();

         return view ('clase.create', compact('asignacionGrupos', 'horarios', 'aulas'));
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
                 'grupo_asignado'=>'required|string|max:100',
                 'horario'=>'required|string|max:100',
                 'aula'=>'required|string|max:100',
                 'fecha'=>'required|date',
                 'asistencia'=>'required|string|max:100',
                 'modalidad'=>'required|string|max:100',
             ];

             $mensaje=[
                 'required'=>'El :attribute es requerido'
             ];

             $this->validate($request, $campos,$mensaje);

         $clases=new Clase();
         $clases->grupoasignado_id=$request->get('grupo_asignado');
         $clases->horario_id=$request->get('horario');
         $clases->aula_id=$request->get('aula');
         $clases->fecha=$request->get('fecha');
         $clases->asistencia=$request->get('asistencia');
         $clases->modalidad=$request->get('modalidad');

         $clases->save();

         return Redirect::to('clase');
     }



     public function obtenerDatosAsignacionGrupo(Request $request)
     {

        $asignacionGrupo = Asignacion_Grupo::with('personas', 'asignaturas', 'grupos')->findOrFail($request->grupo_asignado);
        $nombreCompleto = $asignacionGrupo->personas->nombre . ' ' . $asignacionGrupo->personas->apellido;

        $datos = [
            'persona' => $nombreCompleto,
            'asignatura' => $asignacionGrupo->asignaturas->nombre,
            'grupo' => $asignacionGrupo->grupos->numero_grupo,
        ];

        return response()->json($datos);
    }

     public function obtenerDatosaula(Request $request)
     {

        $aulas = Aula::findOrFail($request->aula);

         $datos = [
             'nomenclatura' => $aulas->nomenclatura,
             'sede' => $aulas->sede,
         ];

         return response()->json($datos);
     }
     public function obtenerDatoshorario(Request $request)
     {

        $horarios = Horario::findOrFail($request->horario);



         $datos = [
             'hora_inicio' => $horarios->hora_inicio,
             'hora_final' => $horarios->hora_final,
             'jornada' => $horarios->jornada,
         ];

         return response()->json($datos);
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
     {   $clases=new Clase;

        $clases= Clase::find($id);
        $asignacionGrupos = Asignacion_Grupo::all();
        $horarios = Horario::all();
        $aulas = Aula::all();

         return view ('clase.edit', compact('clases', 'asignacionGrupos', 'horarios', 'aulas'));
     }



     public function examinar($id)
     {   $clases=new Clase;

        $clases= Clase::find($id);
        $asignacionGrupos = Asignacion_Grupo::all();
        $horarios = Horario::all();
        $aulas = Aula::all();

         return view ('clase.exam', compact('clases', 'asignacionGrupos', 'horarios', 'aulas'));
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
            'grupo_asignado'=>'required|string|max:100',
            'horario'=>'required|string|max:100',
            'aula'=>'required|string|max:100',
            'fecha'=>'required|date',
            'asistencia'=>'required|string|max:100',
            'modalidad'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);


        $clases=new Clase();
        $clases=Clase::findOrFail($id);
        $clases->grupoasignado_id=$request->get('grupo_asignado');
        $clases->horario_id=$request->get('horario');
        $clases->aula_id=$request->get('aula');
        $clases->fecha=$request->get('fecha');
        $clases->asistencia=$request->get('asistencia');
        $clases->modalidad=$request->get('modalidad');

        $clases->save();


         return Redirect::to('clase')->with('mensaje','Clase actualizada');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {

         $clases=Clase::findOrFail($id);

         $clases->delete();


          return Redirect::to('clase');
     }
}
