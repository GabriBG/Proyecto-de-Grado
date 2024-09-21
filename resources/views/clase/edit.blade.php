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

<form action="{{ route('clase.update', $clases->id) }}" method="POST">
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

        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="modalidad" style="color:white;">Modalidad</label>
                <select class="form-control" name="modalidad" id="modalidad">
                    <option value="virtual" {{ $clases->modalidad == "virtual" ? 'selected' : '' }}>Virtual</option>
                    <option value="presencial" {{ $clases->modalidad == "presencial" ? 'selected' : '' }}>Presencial</option>
                </select>
            </div>
        </div>
    </div>
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
    $('#asistencia').change(function() {
        if (this.value == 'asistida') {
            cargarEstudiantes();
        } else {
            $('#estudiantes-container').hide();
        }
    });

    // Mostrar el botón "Cargar Estudiantes" si la asistencia es asistida al cargar la página
    if ($('#asistencia').val() == 'asistida') {
        cargarEstudiantes();
    }

    $('#asistencia-general').change(function() {
        $('input[type=checkbox][name^="asistencia"]').prop('checked', this.checked);
    });

    $('#examForm').submit(function(e) {
        if ($('#asistencia').val() == 'asistida' && $('#estudiantes-table tbody tr').length == 0) {
            e.preventDefault();
            alert('Debe cargar la lista de estudiantes para tomar asistencia.');
        }
    });
});

function cargarEstudiantes() {
    const grupoId = $('#grupo_asignado').val();
    if (grupoId) {
        $.ajax({
            url: '/obtener-estudiantes/' + grupoId,
            method: 'GET',
            success: function(response) {
                const estudiantes = response.estudiantes;
                const tbody = $('#estudiantes-table tbody');
                var contador ="1";
                tbody.empty();
                estudiantes.forEach(estudiante => {
                    const row = `
                        <tr>
                            <td>${contador}</td>
                            <td>${estudiante.nombres} ${estudiante.apellidos}</td>
                            <td><input type="checkbox" name="asistencia_estudiante_${estudiante.id}"></td>
                            <td><input type="text" name="observacion_estudiante_${estudiante.id}" class="form-control"></td>
                        </tr>`;
                        contador ++;
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
