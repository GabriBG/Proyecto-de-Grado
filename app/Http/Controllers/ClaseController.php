<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\{Asignacion_Grupo, Clase, Horaro, Aula, Persona, Asignatura, Grupo, Horario, Estudiante, Asistencia};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class ClaseController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index(Request $request)
     {

        $usuario = Auth::user();

        $nom = $request->input('name');


        $clases = Clase::whereHas('horarios', function ($query) use ($nom) {
            $query->where('hora_inicio', 'like', "%$nom%")
                ->orWhere('hora_final', 'LIKE', "%$nom%");
        })->orWhereHas('asignaturas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%");
        })->orWhereHas('grupos', function ($query) use ($nom) {
            $query->where('numero_grupo', 'LIKE', "%$nom%");
        })->orWhereHas('personas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%")
                ->orWhere('apellido', 'LIKE', "%$nom%");
        })->orWhere('asistencia', "$nom")
        ->with('personas', 'asignaturas', 'grupos', 'horarios', 'asignacionGrupos')->paginate(10);


        $autenticado = Clase::whereHas('horarios', function ($query) use ($nom) {
            $query->where('hora_inicio', 'like', "%$nom%")
                ->orWhere('hora_final', 'LIKE', "%$nom%");
        })
        ->orWhereHas('asignaturas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%");
        })
        ->orWhereHas('grupos', function ($query) use ($nom) {
            $query->where('numero_grupo', 'LIKE', "%$nom%");
        })
        ->orWhereHas('personas', function ($query) use ($nom) {
            $query->where('nombre', 'LIKE', "%$nom%")
                ->orWhere('apellido', 'LIKE', "%$nom%")
                ->whereHas('users', function ($query) {
                    $query->where('id', auth()->user()->id);
                });
        })
        ->orWhere('asistencia', "$nom")
        ->with('personas', 'asignaturas', 'grupos', 'horarios', 'asignacionGrupos')
        ->paginate(10);

        return view('clase.index', compact('clases','autenticado'));

     }
     public function obtenerEstudiantes($grupoId)
     {
         $asignacionGrupo = Asignacion_Grupo::find($grupoId);

         if ($asignacionGrupo && $asignacionGrupo->grupos) {
             $estudiantes = $asignacionGrupo->grupos->estudiantes->map(function($estudiante) {
                 return [
                     'id' => $estudiante->id,
                     'nombres' => $estudiante->nombres,
                     'apellidos' => $estudiante->apellidos,
                 ];
             });
         } else {
             $estudiantes = [];
         }
         return response()->json(['estudiantes' => $estudiantes]);
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

          return view('clase.create', compact('asignacionGrupos', 'horarios'));
      }



     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */

      public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'grupo_asignado' => 'required|exists:asignacion_grupos,id',
        'horario' => 'required|exists:horarios,id',
        'fecha' => 'required|date',
        'asistencia' => 'required|string|max:100',
    ]);

    // Si la clase es "asistida", validar la asistencia de los estudiantes
    if ($request->asistencia == 'asistida') {
        $request->validate([
            'asistencia_estudiantes' => 'required|array', // Validar que se envía asistencia de estudiantes
            'asistencia_estudiantes.*' => 'nullable|boolean', // Cada asistencia debe ser booleano (1 o 0)
            'observacion.*' => 'nullable|string|max:255',
        ]);
    }

    // Crear la clase
    $clase = Clase::create([
        'grupoasignado_id' => $request->grupo_asignado,
        'horario_id' => $request->horario,
        'fecha' => $request->fecha,
        'asistencia' => $request->asistencia,
        'observacionClase' => $request->observacionClase ?: null, // Asignar null si está vacío
    ]);

    // Guardar la asistencia de los estudiantes si la clase es "asistida"
    if ($request->asistencia == 'asistida' && is_array($request->asistencia_estudiantes)) {
        foreach ($request->asistencia_estudiantes as $estudianteId => $asistio) {
            Asistencia::create([
                'clase_id' => $clase->id,
                'estudiante_id' => $estudianteId,
                'asistencia' => $asistio ? 1 : 0, // Asegurarse de que sea 1 o 0
                'observacion' => $request->observacion[$estudianteId] ?? null,
            ]);
        }
    }

    return redirect()->route('clase.index')->with('success', 'Clase creada con éxito.');
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

     public function reporteClasePDF($id)
     {
         // Buscar la clase por ID
         $clase = Clase::with('asignacionGrupos.grupos', 'asignacionGrupos.asignaturas', 'asignacionGrupos.personas')
                     ->where('id', $id)
                     ->first();

         // Obtener datos de la clase
         $docente = $clase->asignacionGrupos->personas;
         $asignatura = $clase->asignacionGrupos->asignaturas;
         $grupo = $clase->asignacionGrupos->grupos;
         $sede = $clase->asignacionGrupos->sede;
         $aula = $clase->asignacionGrupos->aula;
         $fecha = $clase->fecha;
         $horario = $clase->horarios;
         $asistencia = $clase->asistencia;

         // Si la clase fue asistida, obtener la lista de estudiantes
         $estudiantes = [];
         if ($asistencia == 1) { // Asistida
             $estudiantes = Estudiante::where('clase_id', $clase->id)
                         ->where('asistencia', 1) // Solo los que asistieron
                         ->get();
         }

         // Cargar la vista para generar el PDF
         $pdf = Pdf::loadView('pdf.clase-reporte', compact('clase', 'docente', 'asignatura', 'grupo', 'fecha', 'aula', 'sede', 'horario', 'asistencia', 'estudiantes'));
         $pdf->setPaper('carta','A4');

         return $pdf->stream();
     }

     public function examinar($id)
     {
    // Obtener la clase con sus relaciones
    $clases = Clase::with(['asistencias.estudiante', 'asignacionGrupos.grupos', 'asignacionGrupos.personas', 'asignaturas', 'horarios'])
                ->findOrFail($id);


         return view('clase.exam', compact('clases'));
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
              'grupo_asignado' => 'required|string|max:100',
              'horario' => 'required|string|max:100',
              'fecha' => 'required|date',
              'asistencia' => 'required|string|max:100',
          ];

          $mensaje = [
              'required' => 'El :attribute es requerido'
          ];

          $this->validate($request, $campos, $mensaje);

          // Encontrar la clase y actualizar sus campos
          $clases = Clase::findOrFail($id);
          $clases->grupoasignado_id = $request->get('grupo_asignado');
          $clases->horario_id = $request->get('horario');
          $clases->fecha = $request->get('fecha');
          $clases->asistencia = $request->get('asistencia');
          $clases->observacionClase = $request->get('observacionClase') ?? '';
          $clases->save();

          // Guardar la asistencia y observaciones de los estudiantes
          if ($request->get('asistencia') == 'asistida') {
              $grupoId = $request->get('grupo_asignado');
              $estudiantes = Asignacion_Grupo::find($grupoId)->estudiantes;

              foreach ($estudiantes as $estudiante) {
                  $asistenciaEstudiante = $request->input('asistencia_estudiante_' . $estudiante->id) ? true : false;
                  $observacionEstudiante = $request->input('observacion_estudiante_' . $estudiante->id);

                  $asistencia = Asistencia::updateOrCreate(
                      [
                          'clase_id' => $clases->id,
                          'estudiante_id' => $estudiante->id,
                      ],
                      [
                          'asistencia' => $asistenciaEstudiante,
                          'observacion' => $observacionEstudiante,
                      ]
                  );
              }
          }

          return Redirect::to('clase')->with('mensaje', 'Clase actualizada');
      }




     public function confirmar(Request $request, $id)
{
    $request->validate([
        'asistencia' => 'required|string|max:100',
    ]);

    $clase = Clase::findOrFail($id);
    $clase->asistencia = $request->get('asistencia');
    $clase->save();

    if ($request->get('asistencia') == 'asistida') {
        foreach ($request->asistencia_estudiante as $estudianteId => $asistencia) {
            $observacion = $request->observacion[$estudianteId] ?? null;
            Asistencia::updateOrCreate(
                ['clase_id' => $id, 'estudiante_id' => $estudianteId],
                ['asistio' => $asistencia, 'observacion' => $observacion]
            );
        }
    }

    return redirect()->route('clase.index')->with('success', 'Asistencia de Clase Confirmada');
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
