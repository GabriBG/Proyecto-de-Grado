<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Asignatura;
class PdfController extends Controller
{

public function imprimirPersonas(Request $request){

    $nom = $request->input('name');
    $personas = Persona::where('nombre','LIKE',"%$nom%")->
    orWhere('apellido','LIKE',"%$nom%")->
    orWhere('documento_identidad','LIKE',"%$nom%")->paginate(8);
    $pdf = PDF::loadView('pdf.personasPDF',['personas' => $personas ]);
    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}

public function imprimirAsignaturas(Request $request){

    $asignaturas=Asignatura::orderBy('id','ASC')->get();
    $pdf = PDF::loadView('pdf.asignaturasPDF',['asignaturas' => $asignaturas ]);
    $pdf->setPaper('carta','A4');

    return $pdf->stream();

}




}
