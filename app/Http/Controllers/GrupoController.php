<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Grupo;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function index(Request $request)
{
    $nom = $request->input('name');

    // Buscar grupos basados en el nombre o número del grupo
    $grupos = Grupo::where('estudiantes_matriculados', 'LIKE', "%$nom%")
        ->orWhere('numero_grupo', 'LIKE', "%$nom%")
        ->paginate(10);

    // Buscar estudiantes basados en el nombre o apellido
    $estudiantes = Estudiante::where('nombres', 'LIKE', "%$nom%")
        ->orWhere('apellidos', 'LIKE', "%$nom%")
        ->get();

    // Obtener los IDs de los grupos correspondientes a los estudiantes encontrados
    $grupoIds = $estudiantes->pluck('id_grupo');

    // Añadir a la consulta inicial los grupos que corresponden a los estudiantes encontrados
    $gruposPorEstudiantes = Grupo::whereIn('id', $grupoIds)->paginate(6);

    // Combinar los grupos encontrados por búsqueda directa y por estudiantes
    $gruposCombinados = $grupos->merge($gruposPorEstudiantes)->unique('id');

    return view('grupo.index')
        ->with('grupos', $gruposCombinados)
        ->with('estudiantes', $estudiantes);
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
    // Validar los campos del grupo y los estudiantes
    $campos = [
        'estudiantes_matriculados' => 'required|integer|min:1',
        'numero_grupo' => 'required|string|max:100',
        'estudiantes_nombres.*' => 'required|string|max:255',
        'estudiantes_apellidos.*' => 'required|string|max:255'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido'
    ];

    $this->validate($request, $campos, $mensaje);

    // Crear el nuevo grupo
    $grupo = new Grupo;
    $grupo->estudiantes_matriculados = $request->get('estudiantes_matriculados');
    $grupo->numero_grupo = $request->get('numero_grupo');
    $grupo->save();

    // Obtener los nombres y apellidos de los estudiantes del formulario
    $estudiantesNombres = $request->get('estudiantes_nombres');
    $estudiantesApellidos = $request->get('estudiantes_apellidos');

    // Crear registros de estudiantes y asociarlos al grupo
    for ($i = 0; $i < count($estudiantesNombres); $i++) {
        $estudiante = new Estudiante;
        $estudiante->id_grupo = $grupo->id;
        $estudiante->nombres = $estudiantesNombres[$i];
        $estudiante->apellidos = $estudiantesApellidos[$i];
        $estudiante->created_at = now();
        $estudiante->updated_at = now();
        $estudiante->save();
    }

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
    $grupo = Grupo::with('estudiantes')->findOrFail($id);
    return view('grupo.edit', compact('grupo'));
}

public function update(Request $request, $id)
{
    // Validar los campos del grupo y los estudiantes
    $campos = [
        'estudiantes_matriculados' => 'required|string|max:100',
        'numero_grupo' => 'required|string|max:100',
        'estudiantes_nombres' => 'required|array',
        'estudiantes_nombres.*' => 'required|string',
        'estudiantes_apellidos' => 'required|array',
        'estudiantes_apellidos.*' => 'required|string',
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
        'estudiantes_nombres.*.required' => 'El nombre del estudiante es requerido',
        'estudiantes_apellidos.*.required' => 'El apellido del estudiante es requerido'
    ];

    $this->validate($request, $campos, $mensaje);

    $numEstudiantesMatriculados = $request->input('estudiantes_matriculados');
    $numEstudiantesRegistrados = count($request->input('estudiantes_nombres'));

    if ($numEstudiantesMatriculados != $numEstudiantesRegistrados) {
        return redirect()->back()->withErrors(['error' => 'El número de estudiantes registrados no coincide con el número de estudiantes matriculados.']);
    }

    $grupo = Grupo::findOrFail($id);
    $grupo->estudiantes_matriculados = $request->input('estudiantes_matriculados');
    $grupo->numero_grupo = $request->input('numero_grupo');
    $grupo->save();

    // Actualizar estudiantes
    Estudiante::where('id_grupo', $id)->delete();
    $nombres = $request->input('estudiantes_nombres');
    $apellidos = $request->input('estudiantes_apellidos');

    for ($i = 0; $i < count($nombres); $i++) {
        $estudiante = new Estudiante();
        $estudiante->nombres = $nombres[$i];
        $estudiante->apellidos = $apellidos[$i];
        $estudiante->id_grupo = $id;
        $estudiante->save();
    }

    return Redirect::to('grupo')->with('mensaje', 'Grupo y estudiantes actualizados correctamente.');
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
