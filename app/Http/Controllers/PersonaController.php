<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Persona, User, Role};
use Illuminate\Support\Facades\Redirect;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index(Request $request)
    {

       $nom = $request->get('name');
       
        $personas = Persona::where('nombre','LIKE',"%$nom%")->paginate(6);
        $personas = Persona::where('apellido','LIKE',"%$nom%")->paginate(6);
        $personas = Persona::where('documento_identidad','LIKE',"%$nom%")->paginate(6);
        
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
                'username'=>'required|string|max:100',
                'password'=>'required|string|max:100',
                'documento_identidad'=>'required|string|max:100',
                'nombre'=>'required|string|max:100',
                'apellido'=>'required|string|max:100',
                'email'=>'required|string|max:100',
                'telefono'=>'required|string|max:100',
            ];

            $mensaje=[
                'required'=>'El :attribute es requerido'
            ];

            $this->validate($request, $campos,$mensaje);

        $users=new User;
        $personas=new Persona;
        $users->username=$request->get('username');
        $users->password=$request->get('password');
        $users->email=$request->get('email');

        $users->save();

        $personas->documento_identidad=$request->get('documento_identidad');
        $personas->nombre=$request->get('nombre');
        $personas->apellido=$request->get('apellido');
        $personas->telefono=$request->get('telefono');
        $personas->id_usuario=$users->id;

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
    {   $roles=new Role;
        $personas=Persona::findOrFail($id);
        $roles=Role::orderBy('id','DESC')->paginate(6);
        return view ('persona.edit', compact('personas', 'roles'));
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

        $users=new User;
        $users=User::findOrFail($id);
        $personas=Persona::findOrFail($id);
        $personas->documento_identidad=$request->input('documento_identidad');
        $personas->nombre=$request->input('nombre');
        $personas->apellido=$request->input('apellido');
        $users->email=$request->input('email');
        $personas->telefono=$request->input('telefono');
        $personas->save();
        $users->save();

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

        $users=User::findOrFail($id);
        $personas=Persona::findOrFail($id);
        
        $users->delete();
        $personas->delete();
        


         return Redirect::to('persona');
    }
}
