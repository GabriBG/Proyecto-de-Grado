<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Aula;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aulas = Aula::orderBy('id','DESC')->paginate(3);

        return view('aula.index',compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aula.create');
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
            'nomenclatura'=>'required|string|max:100',
            'sede'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $aulas=new Aula;
        $aulas->codigo=$request->get('nomenclatura');
        $aulas->nombre=$request->get('sede');
        $aulas->created_at-> now();
        $aulas->updated_at-> now();

        $aulas->save();

        return Redirect::to('aula');
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
        $aulas=Aula::findOrFail($id);
        return view('aula.edit', compact('aulas'));
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
            'nomenclatura'=>'required|string|max:100',
            'sede'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $aulas=Aula::findOrFail($id);
        $aulas->nomenclatura=$request->input('nomenclatura');
        $aulas->sede=$request->input('sede');
        $aulas->updated_at-> now();
        $aulas->save();

        return Redirect::to('aula');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $aulas=Aula::findOrFail($id);
        Aula::destroy($id);


        $aulas->delete();


         return Redirect::to('aula');
    }
}
