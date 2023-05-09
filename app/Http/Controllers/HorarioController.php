<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Horario, Asignatura};
use Illuminate\Support\Facades\Redirect;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nom = $request->input('name');

        $horarios = Horario::where('jornada','LIKE',"%$nom%")->
        orWhere('hora_inicio','LIKE',"%$nom%")->
        orWhere('hora_final','LIKE',"%$nom%")->paginate(6);
  return view('horario.index',compact('horarios'));

        // return view('horario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('horario.create');
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
                'jornada'=>'required|string|max:100',
                'hora_inicio'=>'required|string|max:100',
                'hora_final'=>'required|string|max:100',
            ];

            $mensaje=[
                'required'=>'El :attribute es requerido'
            ];

            $this->validate($request, $campos,$mensaje);

        $asignaturas=new Asignatura;
        $horarios=new Horario;

        $horarios->jornada=$request->get('jornada');
        $horarios->hora_inicio=$request->get('hora_inicio');
        $horarios->hora_final=$request->get('hora_final');
        $horarios->id_asignatura=$asignaturas->id;

        $horarios->save();

        return Redirect::to('horario');
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
    {
        $horarios=Horario::findOrFail($id);
        return view ('horario.edit', compact('horarios'));
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
            'jornada'=>'required|string|max:100',
            'hora_inicio'=>'required|string|max:100',
            'hora_final'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $horarios=Horario::findOrFail($id);
        $horarios->jornada=$request->input('jornada');
        $horarios->hora_inicio=$request->input('hora_inicio');
        $horarios->hora_final=$request->input('hora_final');
        $horarios->save();

        return Redirect::to('horario')->with('mensaje','Horario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $horarios=Horario::findOrFail($id);

        $horarios->delete();



         return Redirect::to('horario');
    }
}

