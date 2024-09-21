<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Clase;
use App\Models\Horario;
use Illuminate\Http\Request;
use PDF;

class AsistenciaController extends Controller
{
    // Método para listar asistencias con filtros
    public function index(Request $request)
    {
        // Obtener los parámetros de búsqueda
        $asignatura = $request->input('asignatura');
        $docente = $request->input('docente');
        $fecha_clase = $request->input('fecha_clase');
        $grupo = $request->input('grupo');
        $estudiante = $request->input('estudiante');
        $horario = $request->input('horario'); // Capturamos el valor del horario

        // Obtener todos los horarios registrados (suponiendo que tengas un modelo Horario)
        $horarios = Horario::all();

        // Iniciar la consulta de asistencias
        $query = Asistencia::query();

        // Aplicar los filtros
        if ($asignatura) {
            $query->whereHas('clase.asignaturas', function($q) use ($asignatura) {
                $q->where('nombre', 'like', "%{$asignatura}%");
            });
        }

        if ($docente) {
            $query->whereHas('clase.personas', function($q) use ($docente) {
                $q->where('nombre', 'like', "%{$docente}%")
                  ->orWhere('apellido', 'like', "%{$docente}%");
            });
        }

        if ($fecha_clase) {
            $query->whereDate('created_at', $fecha_clase);
        }

        if ($grupo) {
            $query->whereHas('clase.grupos', function($q) use ($grupo) {
                $q->where('numero_grupo', 'like', "%{$grupo}%");
            });
        }

        if ($estudiante) {
            $query->whereHas('estudiante', function($q) use ($estudiante) {
                $q->where('nombres', 'like', "%{$estudiante}%")
                  ->orWhere('apellidos', 'like', "%{$estudiante}%");
            });
        }

        // Filtro por horario
        if ($horario) {
            $query->whereHas('clase.horarios', function($q) use ($horario) {
                $q->where('id', $horario);
            });
        }

        // Ejecutar la consulta
        $asistencias = $query->paginate(10);

        // Retornar la vista con las asistencias y los horarios
        return view('asistencia.index', compact('asistencias', 'horarios'));
    }


    // Método para ver una asistencia en detalle
    public function show($id)
    {
        $asistencia = Asistencia::with(['estudiante', 'clase', 'clase.personas', 'clase.asignaturas'])->findOrFail($id);
        return view('asistencia.show', compact('asistencia'));
    }


    // Método para editar una asistencia
    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        return view('asistencia.edit', compact('asistencia'));
    }

    // Método para actualizar una asistencia
    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);

        $request->validate([
            'asistencia' => 'required',
            'observacion' => 'nullable|string',
        ]);

        $asistencia->update($request->all());

        return redirect()->route('asistencia.index')->with('mensaje', 'Asistencia actualizada correctamente.');
    }

    // Método para generar un reporte PDF de asistencias
    public function imprimirAsistencia(Request $request)
{
    // Obtener los mismos filtros que en el método index
    $asignatura = $request->input('asignatura');
    $docente = $request->input('docente');
    $fecha_clase = $request->input('fecha_clase');
    $estado_asistencia = $request->input('estado_asistencia');
    $grupo = $request->input('grupo');
    $estudiante = $request->input('estudiante');
    $clase_id = $request->input('clase');
    $horario_id = $request->input('horario');

    // Consulta base para obtener las asistencias
    $query = Asistencia::query();

    // Filtro por asignatura
    if ($asignatura) {
        $query->whereHas('clase.asignaturas', function ($q) use ($asignatura) {
            $q->where('nombre', 'LIKE', '%' . $asignatura . '%');
        });
    }

    // Filtro por docente (nombre o apellido)
    if ($docente) {
        $query->whereHas('clase.personas', function ($q) use ($docente) {
            $q->where('nombre', 'LIKE', '%' . $docente . '%')
              ->orWhere('apellido', 'LIKE', '%' . $docente . '%');
        });
    }

    // Filtro por fecha de clase
    if ($fecha_clase) {
        $query->whereDate('created_at', '=', $fecha_clase);
    }

    // Filtro por estado de asistencia (ajustamos para incluir el valor 0)
    if (!is_null($estado_asistencia)) {
        $query->where('asistencia', $estado_asistencia);
    }

    // Filtro por clase
    if ($clase_id) {
        $query->where('clase_id', $clase_id);
    }
    if ($grupo) {
        $query->whereHas('clase.grupos', function($q) use ($grupo) {
            $q->where('numero_grupo', 'like', "%{$grupo}%");
        });
    }


    if ($estudiante) {
        $query->whereHas('estudiante', function($q) use ($estudiante) {
            $q->where('nombres', 'like', "%{$estudiante}%")
              ->orWhere('apellidos', 'like', "%{$estudiante}%");
        });
    }

    // Filtro por horario (ajustamos la relación a 'horarios' en plural)
    if ($horario_id) {
        $query->whereHas('clase.horarios', function ($q) use ($horario_id) {
            $q->where('id', $horario_id);
        });
    }

    // Obtener asistencias con relaciones necesarias
    $asistencias = $query->with([
        'clase',
        'estudiante',
        'clase.personas',
        'clase.asignaturas',
        'clase.horarios'
    ])->get();

    // Verificar que se obtuvieron los datos correctos (descomenta para depurar)
    // dd($asistencias);

    // Generar PDF
    $pdf = PDF::loadView('pdf.asistenciaPDF', compact('asistencias'));
    $pdf->setPaper('carta','A4');

    return $pdf->stream();
}


    // Método para eliminar una asistencia
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()->route('asistencia.index')->with('mensaje', 'Asistencia eliminada correctamente.');
    }
}
