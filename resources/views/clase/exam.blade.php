@extends('layouts.app', ['page' => ('Clases'),'pageSlug' => 'clase'])

@section('content')
<h1>Examinar Clase</h1>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h4>Clase</h4>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<form action="{{ route('clase.update', $clases->id) }}" method="post" id="examForm">
    {{ csrf_field() }}
    @method('PUT')

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
                <input type="text" name="" id="" style="color:white" class="form-control" value="{{ $clases->asignacionGrupos->grupos->numero_grupo }}" readonly>
                <input type="hidden" name="grupo_asignado" id="grupo_asignado" value="{{ $clases->asignacionGrupos->id }}">
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
            <div class="form-group">
                <label for="persona" style="color:white;">Docente:</label>
                <input type="text" name="persona" id="persona" style="color:white" class="form-control" value="{{ $clases->asignacionGrupos->personas->nombre }} {{ $clases->asignacionGrupos->personas->apellido }}" readonly>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="asignatura" style="color:white;">Asignatura:</label>
                <input type="text" name="asignatura" id="asignatura" style="color:white" class="form-control" value="{{ $clases->asignaturas->nombre }}" readonly>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="horario" style="color:white;">Horario:</label>
                <input type="text" name="" id="" style="color:white" class="form-control" value="{{ $clases->horarios->hora_inicio }} - {{ $clases->horarios->hora_final }}" readonly>
                <input type="hidden" name="horario" id="horario" value="{{ $clases->horarios->id }}">
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="jornada" style="color:white;">Jornada:</label>
                <input type="text" name="jornada" id="jornada" style="color:white" class="form-control" value="{{ $clases->horarios->jornada }}" readonly>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="fecha" style="color:white;">Fecha:</label>
                <input class="form-control" type="date" style="color:white;" value="{{ old('fecha', \Carbon\Carbon::parse($clases->fecha)->format('Y-m-d')) }}" name="fecha" id="fecha" readonly>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="asistencia" style="color:white;">Confirmar Asistencia:</label>
                <select class="form-control" name="asistencia" id="asistencia" style="color:white;">
                @if ($clases->asistencia == 'asistida' || $clases->asistencia == 'inasistida')
                <option value="{{$clases->asistencia}}" {{ $clases->asistencia == 'asistida' ? 'selected' : '' }}>{{ucfirst($clases->asistencia)}}</option>
            </select>
        </div>
    </div>
    @if ($clases->asistencia == 'inasistida')
     <!-- Campo para la observación -->
     <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="observacion" style="color:white;">Observación:</label>

            <!-- Mostrar observación si la clase está 'inasistida' -->
            @if($clases->asistencia == 'inasistida')
                <textarea class="form-control" name="observacionClase" id="observacionClase" style="color:white;" readonly>{{ $clases->observacionClase }}</textarea>

            <!-- Mostrar un campo editable si la asistencia es 'pendiente' -->
            @elseif($clases->asistencia == 'pendiente')
                <textarea class="form-control" name="observacionClase" id="observacionClase" style="color:white;">{{ old('observacionClase', $clases->observacionClase) }}</textarea>
            @endif
        </div>
    </div>
@endif
</div>
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
<br>

<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<a class="btn btn-danger" href="{{ route('clase.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>

</form>
                @else
                    <option value="pendiente" {{ $clases->asistencia == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="asistida" {{ $clases->asistencia == 'asistida' ? 'selected' : '' }}>Asistida</option>
                    <option value="inasistida" {{ $clases->asistencia == 'inasistida' ? 'selected' : '' }}>Inasistida</option>
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

    <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
    <a class="btn btn-danger" href="{{ route('clase.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>

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
                $('#observacion').prop('readonly', true).val(''); // Deshabilitar campo de observación
                $('#observacion-container').hide(); // Esconder el campo de observación
            }
            // Si el estado es 'inasistida', mostrar campo observación y ocultar estudiantes
            else if (estadoAsistencia == 'inasistida') {
                $('#estudiantes-container').hide(); // Esconder lista de estudiantes
                $('#observacion-container').show(); // Mostrar el campo de observación
                $('#observacion').prop('readonly', false).val(''); // Habilitar el campo observación
            }
            // Si se selecciona otro estado, esconder campo observación y lista de estudiantes
            else {
                $('#estudiantes-container').hide(); // Esconder lista de estudiantes
                $('#observacion-container').hide(); // Esconder el campo de observación
                $('#observacion').prop('readonly', false).val(''); // Limpiar observación
            }
        });

        // Controlar el checkbox general para seleccionar/deseleccionar todos los estudiantes
        $('#asistencia-general').change(function() {
            var isChecked = $(this).prop('checked');
            $('input[type=checkbox][name^="asistencia_estudiante_"]').prop('checked', isChecked);
        });

        // Validar antes de enviar el formulario
        $('#examForm').submit(function(e) {
            var estadoAsistencia = $('#asistencia').val();
            var observacionClase = $('#observacionClase').val().trim();

            // Si el estado es 'inasistida', verificar que se haya ingresado una observación
            if (estadoAsistencia == 'inasistida' && observacionClase == '') {
                e.preventDefault(); // Evitar que se envíe el formulario
                alert('Debe ingresar una observación si la asistencia es "inasistida".');
            }

            // Validar si el estado es 'asistida' y no hay estudiantes cargados
            if (estadoAsistencia == 'asistida' && $('#estudiantes-table tbody tr').length == 0) {
                e.preventDefault();
                alert('Debe cargar la lista de estudiantes para tomar asistencia.');
            }
        });
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




@endif
@endsection
