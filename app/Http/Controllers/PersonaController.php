<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Redirect;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $personas = Persona::orderBy('id','DESC')->paginate(3);
  //      $personas =DB::table('personas', 'users')->select('id', 'documento_identidad', 'nombre', 'apellido', 'email', 'telefono')->where('id_usuario','=','users.id')->paginate(3); 
 // $personas = Persona::select('id', 'documento_identidad', 'nombre', 'apellido', 'email', 'telefono')->from('personas', 'users')->where('id_usuario','=','users.id')->paginate(3);
  
  return view('persona.index',compact('personas'));

        // return view('persona.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('persona.create');
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
                'id_usuario'=>'required|string|max:15',
                'documento_identidad'=>'required|string|max:100',
                'nombre'=>'required|string|max:100',
                'apellido'=>'required|string|max:100',
                'telefono'=>'required|string|max:100',
            ];

            $mensaje=[
                'required'=>'El :attribute es requerido'
            ];

            $this->validate($request, $campos,$mensaje);


        $personas=new Persona;
        $personas->id_usuario=$request->get('id_usuario');
        $personas->documento_identidad=$request->get('documento_identidad');
        $personas->nombre=$request->get('nombre');
        $personas->apellido=$request->get('apellido');
        $personas->telefono=$request->get('telefono');

        $personas->save();

        return Redirect::to('persona');
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
        $personas=Persona::findOrFail($id);
        return view ('persona.edit', compact('personas'));
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


        $personas=Persona::findOrFail($id);
        $personas->documento_identidad=$request->input('documento_identidad');
        $personas->nombre=$request->input('nombre');
        $personas->apellido=$request->input('apellido');
        $personas->email=$request->input('email');
        $personas->telefono=$request->input('telefono');
        $personas->save();

        return Redirect::to('persona')->with('mensaje','Persona Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $personas=Persona::findOrFail($id);


        $personas->delete();


         return Redirect::to('persona');
    }
}
