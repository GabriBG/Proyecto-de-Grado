<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Asignatura;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaturas = Asignatura::orderBy('id','DESC')->paginate(3);

        return view('asignatura.index',compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asignatura.create');
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
            'codigo'=>'required|string|max:100',
            'nombre'=>'required|string|max:100',
            'creditos'=>'required|int|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $asignaturas=new Asignatura;
        $asignaturas->codigo=$request->get('codigo');
        $asignaturas->nombre=$request->get('nombre');
        $asignaturas->creditos=$request->get('creditos');

        $asignaturas->save();

        return Redirect::to('asignatura');
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
        $asignaturas=Asignatura::findOrFail($id);
        return view('asignatura.edit', compact('asignaturas'));
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
            'codigo'=>'required|string|max:100',
            'nombre'=>'required|string|max:100',
            'creditos'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $asignaturas=Asignatura::findOrFail($id);
        $asignaturas->codigo=$request->input('codigo');
        $asignaturas->nombre=$request->input('nombre');
        $asignaturas->creditos=$request->input('creditos');
        $asignaturas->created_at-> now();
        $asignaturas->updated_at-> now();
        $asignaturas->save();

        return Redirect::to('asignatura');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $asignaturas=Asignatura::findOrFail($id);
        Asignatura::destroy($id);


        $asignaturas->delete();


         return Redirect::to('asignatura');
    }
}
