<?php

namespace App\Http\Controllers;

use App\Models\Asignacion_Grupo;
use PDF;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Asignatura;
use App\Models\Clase;


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


public function imprimirClase(Request $request){

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

    $pdf = PDF::loadView('pdf.clasePDF',['clases' => $clases ]);
    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}

}
