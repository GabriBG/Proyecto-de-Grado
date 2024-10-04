<?php

namespace App\Http\Controllers;

use App\Models\Asignacion_Grupo;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Asistencia;
use PDF;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Asignatura;
use App\Models\Clase;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class PdfController extends Controller
{

public function imprimirPersonas(Request $request){

    $nom = $request->input('name');

        $rolId = '2';
        $docentes = Persona::whereHas('users.roles', function ($query) use ($rolId, $nom) {
            $query->where('id', $rolId)
                ->where(function ($query) use ($nom) {
                    $query->where('nombre', 'LIKE', "%$nom%")
                        ->orWhere('apellido', 'LIKE', "%$nom%")
                        ->orWhere('documento_identidad', 'LIKE', "%$nom%");
                });
        })->get();
    $pdf = PDF::loadView('pdf.personasPDF',compact('docentes'));

    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}

public function imprimirAsignaturas(Request $request){

    $nom = $request->input('name');

    $asignaturas = Asignatura::where('nombre','LIKE',"%$nom%")->
    orWhere('codigo','LIKE',"%$nom%")->
    orWhere('creditos','LIKE',"%$nom%")->paginate(6);
    $pdf = PDF::loadView('pdf.asignaturasPDF',['asignaturas' => $asignaturas ]);
    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}

public function imprimirAsignacion(Request $request){

    $nom = $request->input('name');

    $asignacion_grupos = Asignacion_Grupo::whereHas('personas', function ($query) use ($nom) {
        $query->where('nombre', 'LIKE', "%$nom%")
              ->orWhere('apellido', 'LIKE', "%$nom%");
    })->orWhereHas('asignaturas', function ($query) use ($nom) {
        $query->where('nombre', 'LIKE', "%$nom%");
    })->orWhereHas('grupos', function ($query) use ($nom) {
        $query->where('numero_grupo', 'LIKE', "%$nom%");
    })->with('personas', 'asignaturas', 'grupos')->get();
    $pdf = PDF::loadView('pdf.asignacionGruposPDF',['asignacion_grupos' => $asignacion_grupos ]);
    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}
public function reporteDocente($id)
{
    // Encontrar al docente por su ID
    $docente = Persona::find($id);

    // Obtener asignaturas que el docente imparte
    $asignaturas = Asignatura::whereHas('asignacionesGrupos', function ($query) use ($docente) {
        $query->where('persona_id', $docente->id);
    })->get();

    // Obtener los grupos a los que el docente da clases
    $grupos = Grupo::whereHas('asignacionesGrupos', function ($query) use ($docente) {
        $query->where('persona_id', $docente->id);
    })->get();

    // Obtener clases inasistidas por los estudiantes bajo este docente
    $inasistencias = Clase::where('asistencia', 'inasistida')
    ->whereHas('asignacionGrupos', function ($query) use ($docente) {
        $query->where('persona_id', $docente->id);
    })
    ->with(['asignacionGrupos'])
    ->get();


    // Generar PDF
    $pdf = \PDF::loadView('pdf.docente-pdf', compact('docente', 'asignaturas', 'grupos', 'inasistencias'));
    $pdf->setPaper('carta','A4');

    return $pdf->stream();
}


public function imprimirClase(Request $request){

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
    ->with('personas', 'asignaturas', 'grupos', 'horarios', 'asignacionGrupos')->get();

    $pdf = PDF::loadView('pdf.clasePDF',['clases' => $clases ]);
    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}



public function generarReporteEstudiante($id)
{
    // Obtener el estudiante por su ID
    $estudiante = Estudiante::findOrFail($id);

    // Obtener el grupo del estudiante usando el id_grupo
    $grupo = Grupo::find($estudiante->id_grupo);

    // Obtener las asistencias del estudiante junto con las clases, asignacion_grupo (para la asignatura) y docentes
    $asistencias = Asistencia::where('estudiante_id', $id)
                    ->with(['clase.asignacionGrupos.asignaturas', 'clase.personas'])
                    ->get();

    // Contar las asistencias e inasistencias correctamente
    $totalAsistencias = $asistencias->where('asistencia', '1')->count();
    $totalInasistencias = $asistencias->where('asistencia', '0')->count();

    // Obtener las fechas de inasistencias correctamente
    $fechasInasistencias = $estudiante->asistencias->where('asistencia', '0')->pluck('created_at');

    // Obtener la información de la asignatura y el docente (persona)
    $inasistenciasDetalles = $estudiante->asistencias->where('asistencia', '0')->map(function ($asistencia) {
        return [
            'fecha' => $asistencia->created_at,
            'asignatura' => $asistencia->clase->asignacionGrupos->asignaturas->nombre ?? 'N/A',
            'nombredocente' => $asistencia->clase->asignacionGrupos->personas->nombre ?? 'N/A',
            'apellidodocente' => $asistencia->clase->asignacionGrupos->personas->apellido ?? 'N/A'
        ];
    });

    // Crear los datos para la vista
    $data = [
        'estudiante' => $estudiante,
        'grupo' => $grupo, // Añadimos el grupo a los datos que pasamos a la vista
        'totalAsistencias' => $totalAsistencias,
        'totalInasistencias' => $totalInasistencias,
        'fechasInasistencias' => $fechasInasistencias,
        'inasistenciasDetalles' => $inasistenciasDetalles,
    ];

    // Cargar la vista y generar el PDF
    $pdf = PDF::loadView('estudiantes.detalle_estudiante', $data);
    $pdf->setPaper('carta', 'A4');

    return $pdf->stream();
}






}
