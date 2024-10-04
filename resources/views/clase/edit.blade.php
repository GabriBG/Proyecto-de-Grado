@extends('layouts.app', ['page' => ('Clases'),'pageSlug' => 'clase'])

@role('Admin|Docente')
@section('content')
<h1>Clase</h1>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h4>Actualizar Clase</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<form action="{{ route('clase.update', $clases->id) }}" method="POST" id="editForm">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
                <select class="form-control" name="grupo_asignado" id="grupo_asignado">
                    @foreach ($asignacionGrupos as $grupoAsignado)
                        @if(auth()->user()->hasRole('Admin') || $grupoAsignado->personas->id_usuario == auth()->id())
                            <option value="{{ $grupoAsignado->id }}" {{ $grupoAsignado->id == $clases->grupoasignado_id ? 'selected' : '' }}>
                                {{ $grupoAsignado->grupos->numero_grupo }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="persona" style="color:white;">Docente</label>
                <input type="text" class="form-control" value="{{ $clases->asignacionGrupos->personas->nombre }} {{ $clases->asignacionGrupos->personas->apellido }}" readonly>
            </div>
        </div>

        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="asignatura" style="color:white;">Asignatura</label>
                <input type="text" class="form-control" value="{{ $clases->asignaturas->nombre }}" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="horario" style="color:white;">Horario</label>
                <select class="form-control" name="horario" id="horario">
                    @foreach ($horarios as $hora)
                        <option value="{{ $hora->id }}" {{ $hora->id == $clases->horario_id ? 'selected' : '' }}>
                            {{ $hora->hora_inicio }} - {{ $hora->hora_final }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="jornada" style="color:white;">Jornada</label>
                <input type="text" class="form-control" value="{{ $clases->horarios->jornada }}" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="aula" style="color:white;">Aula</label>
                <select class="form-control" name="aula" id="aula">
                    @foreach ($aulas as $aul)
                        <option value="{{ $aul->id }}" {{ $aul->id == $clases->aula_id ? 'selected' : '' }}>
                            {{ $aul->nomenclatura }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="fecha" style="color:white;">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($clases->fecha)->format('Y-m-d')) }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="asistencia" style="color:white;">Asistencia</label>
                <select class="form-control" name="asistencia" id="asistencia">
                    <option value="pendiente" {{ $clases->asistencia == "pendiente" ? 'selected' : '' }}>Pendiente</option>
                    <option value="asistida" {{ $clases->asistencia == "asistida" ? 'selected' : '' }}>Asistida</option>
                    <option value="inasistida" {{ $clases->asistencia == "inasistida" ? 'selected' : '' }}>Inasistida</option>
                </select>
            </div>
        </div>
        <div id="observacion-container" style="display: none;">
            <div class="form-group">
                <label for="observacion" style="color:white;">Observación:</label>
                <textarea class="form-control" name="observacionClase" id="observacionClase" style="color:white;">{{ old('observacionClase', $clases->observacionClase) }}</textarea>
            </div>
        </div>
    </div>
    <div class="row" id="cargar-estudiantes-btn" style="display:none;">
        <div class="col-lg-12">
            <button class="btn btn-info" type="button" onclick="cargarEstudiantes()">Cargar Estudiantes</button>
        </div>
    </div>
    <br>
    @if($clases->asistencia == 'asistida')
<div id="estudiantes-container" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table" id="estudiantes-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Estudiante</th>
                    <th>Asistencia</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clases->asistencias as $index => $asistencia)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $asistencia->estudiante->nombres }} {{ $asistencia->estudiante->apellidos }}</td>
                        <td>{{ $asistencia->asistencia == '1' ? 'Asistió' : 'No asistió' }}</td>
                        <td>{{ $asistencia->observacion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
    <div id="estudiantes-container" class="row" style="display: none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table" id="estudiantes-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Estudiante</th>
                        <th><input type="checkbox" id="asistencia-general"> Asistencia</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
            <a class="btn btn-danger" href="{{ route('clase.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Detectar el cambio en el select de asistencia
    $('#asistencia').change(function() {
        var estadoAsistencia = this.value;

        // Si el estado es 'asistida', cargar estudiantes y limpiar la observación
        if (estadoAsistencia == 'asistida') {
            cargarEstudiantes();
            $('#cargar-estudiantes-btn').show();
            $('#observacion').prop('readonly', true).val(''); // Deshabilitar campo de observación
            $('#observacion-container').hide(); // Esconder el campo de observación
        }
        // Si el estado es 'inasistida', mostrar campo observación y ocultar estudiantes
        else if (estadoAsistencia == 'inasistida') {
            $('#estudiantes-container').hide(); // Esconder lista de estudiantes
            $('#observacion-container').show(); // Mostrar el campo de observación
            $('#observacion').prop('readonly', false); // Habilitar el campo observación
            $('#cargar-estudiantes-btn').hide();
        }
        // Si se selecciona otro estado, esconder campo observación y lista de estudiantes
        else {
            $('#estudiantes-container').hide(); // Esconder lista de estudiantes
            $('#observacion-container').hide(); // Esconder el campo de observación
            $('#observacion').prop('readonly', false).val(''); // Limpiar observación
            $('#cargar-estudiantes-btn').hide();
        }
    });

    // Al cargar la página, verificar el estado actual de la clase
    var estadoAsistenciaInicial = $('#asistencia').val();
    if (estadoAsistenciaInicial == 'inasistida') {
        $('#observacion-container').show(); // Mostrar el campo de observación si es 'inasistida'
        $('#observacion').prop('readonly', false); // Habilitar el campo observación
    }
});


    // Función para cargar los estudiantes (ya implementada)
    function cargarEstudiantes() {
        const grupoId = $('#grupo_asignado').val();
        if (grupoId) {
            $.ajax({
                url: '/obtener-estudiantes/' + grupoId,
                method: 'GET',
                success: function(response) {
                    const estudiantes = response.estudiantes;
                    const tbody = $('#estudiantes-table tbody');
                    var contador = "1";
                    tbody.empty();
                    estudiantes.forEach(estudiante => {
                        const row = `
                            <tr>
                                <td>${contador}</td>
                                <td>${estudiante.nombres} ${estudiante.apellidos}</td>
                                <td><input type="checkbox" name="asistencia_estudiante_${estudiante.id}"></td>
                                <td><input type="text" name="observacion_estudiante_${estudiante.id}" class="form-control"></td>
                            </tr>`;
                        contador++;
                        tbody.append(row);
                    });
                    $('#estudiantes-container').show();
                },
                error: function(error) {
                    console.error('Error al cargar los estudiantes:', error);
                }
            });
        }
    }
    </script>
{!! Html::script('./js/metodos.js') !!}
@endsection
@endrole
