<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Grupo;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::orderBy('id','DESC')->paginate(3);

        return view('grupo.index',compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grupo.create');
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
            'estudiantes_matriculados'=>'required|string|max:100',
            'numero_grupo'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $grupos=new Grupo;
        $grupos->estudiantes_matriculados=$request->get('estudiantes_matriculados');
        $grupos->numero_grupo=$request->get('numero_grupo');

        $grupos->save();

        return Redirect::to('grupo');
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
        $grupos=Grupo::findOrFail($id);
        return view('grupo.edit', compact('grupos'));
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
            'estudiantes_matriculados'=>'required|string|max:100',
            'numero_grupo'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $grupos=Grupo::findOrFail($id);
        $grupos->nomenclatura=$request->input('nomenclatura');
        $grupos->sede=$request->input('sede');
        $grupos->save();

        return Redirect::to('grupo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $asignaturas=Grupo::findOrFail($id);
        Grupo::destroy($id);


        $asignaturas->delete();


         return Redirect::to('grupo');
    }
}