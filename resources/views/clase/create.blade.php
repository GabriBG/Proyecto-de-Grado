@extends('layouts.app', ['page' => ('Clases'), 'pageSlug' => 'crearC'])
@role('Admin')

@section('content')
<h1 style="color:yellow">Registrar Clase</h1>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <br>
        @if (count($errors)>0)
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

{!! Form::open(array('url'=>'clase','method'=>'POST','autocomplete'=>'off', 'id' => 'claseForm')) !!}
{{ Form::token() }}
@csrf

<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
            <select class="form-control" style="color=#FFFFFF;" name="grupo_asignado" id="grupo_asignado">
                <option value="">Seleccione el grupo</option>
                @foreach($asignacionGrupos as $asigna)
                <option value="{{ $asigna->id }}">{{ $asigna->grupos->numero_grupo }} {{ $asigna->asignaturas->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
        <div class="form-group">
            <label for="persona" style="color:white;">Docente:</label>
            <input type="text" name="persona" id="persona" style="color:white;" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asignatura" style="color:white;">Asignatura:</label>
            <input type="text" name="asignatura" id="asignatura" style="color:white;" class="form-control" readonly>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="horario" style="color:white;">Horario:</label>
            <select class="form-control" style="color=#FFFFFF;" name="horario" id="horario">
                <option value="">Seleccione el horario</option>
                @foreach($horarios as $hora)
                <option value="{{ $hora->id }}">{{ $hora->hora_inicio }} - {{ $hora->hora_final }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="jornada" style="color:white;">Jornada:</label>
            <input type="text" name="jornada" id="jornada" style="color:white;" class="form-control" readonly>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="fecha" style="color:white;">Fecha:</label>
            <input class="form-control" type="date" name="fecha" id="fecha">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asistencia" style="color:white;">Asistencia:</label>
            <select class="form-control" style="color=#FFFFFF;" name="asistencia" id="asistencia">
                <option value="">Seleccione el estado de asistencia</option>
                <option value="asistida">Asistida</option>
                <option value="inasistida">Inasistida</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
    </div>
    <div class="row" id="observacion-container" style="display:none;">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="observacionClase" style="color:white;">Observación:</label>
                <textarea class="form-control"name="observacionClase" id="observacionClase" style="width: 100%; height: 150px;"></textarea>
            </div>
        </div>
    </div>

</div><div class="row" id="cargar-estudiantes-btn" style="display:none;">
    <div class="col-lg-12">
        <button class="btn btn-info" type="button" onclick="cargarEstudiantes()">Cargar Estudiantes</button>
    </div>
</div>
<br>
<!-- Contenedor para la lista de estudiantes -->
<div class="row" id="estudiantes-container" style="display:none;">
    <div class="col-lg-12">
        <h4 style="color:white;">Lista de Estudiantes</h4>
        <table class="table table-bordered table-hover" id="estudiantes-table">
            <thead>
                <tr>
                    <th style="color:white;">#</th>
                    <th style="color:white;">Nombre</th>
                    <th style="color:white;">Asistencia <input type="checkbox" id="asistencia-general"></th>
                    <th style="color:white;">Observaciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
<br>
<br>
<label style="color:white;">¿No encuentra su horario o aula?</label>
<br>
<a style="color:rgb(33, 222, 255);" target="_blank" href="{{route('horario.create')}}">Registrar Horario</a>
<br>
<a style="color:rgb(0, 217, 255);" target="_blank" href="{{route('aula.create')}}">Registrar Aula</a>

{!! Form::close() !!}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! Html::script('./js/metodos.js') !!}

<script>
$(document).ready(function() {
    $('#asistencia').change(function() {
        var asistencia = $(this).val();

        // Mostrar el botón para cargar estudiantes si la asistencia es "asistida"
        if (asistencia == 'asistida') {
            $('#cargar-estudiantes-btn').show();
            $('#observacion-container').hide(); // Ocultar el campo de observación
        } else if (asistencia == 'inasistida') {
            $('#observacion-container').show(); // Mostrar el campo de observación
            $('#cargar-estudiantes-btn').hide(); // Ocultar el botón de cargar estudiantes
            $('#estudiantes-container').hide(); // Ocultar la tabla de estudiantes
        } else {
            $('#cargar-estudiantes-btn').hide(); // Ocultar ambos
            $('#observacion-container').hide();
            $('#estudiantes-container').hide();
        }
    });

        $('#asistencia-general').change(function() {
            var isChecked = $(this).is(':checked');
            $('#estudiantes-table tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        $('#claseForm').submit(function(event) {
        var asistencia = $('#asistencia').val();
        var observacion = $('#observacion').val().trim();

        // Validar que el campo de observación no esté vacío si la asistencia es "inasistida"
        if (asistencia == 'inasistida' && observacion === '') {
            alert('Debe llenar el campo de observación para una clase inasistida.');
            event.preventDefault(); // Prevenir el envío del formulario si está vacío
        }
    });
});

function cargarEstudiantes() {
    var grupoId = $('#grupo_asignado').val();
    if (grupoId) {
        $.ajax({
            url: '{{ url('obtener-estudiantes') }}/' + grupoId,
            method: 'GET',
            success: function(response) {
                var estudiantes = response.estudiantes;
                var tbody = $('#estudiantes-table tbody');
                var contador = 1;
                tbody.empty();
                estudiantes.forEach(function(estudiante) {
                    var row = `<tr>
                        <td>${contador}</td>
                        <td style="color:white;">${estudiante.nombres} ${estudiante.apellidos}</td>
                        <td>
                            <!-- Campo oculto para inasistencia -->
                            <input type="hidden" name="asistencia_estudiantes[${estudiante.id}]" value="0">
                            <!-- Checkbox para marcar asistencia -->
                            <input type="checkbox" name="asistencia_estudiantes[${estudiante.id}]" value="1">
                        </td>
                        <td><input type="text" name="observacion[${estudiante.id}]" class="form-control"></td>
                    </tr>`;
                    contador++;
                    tbody.append(row);
                });
                $('#estudiantes-container').show();
            }
        });
    } else {
        alert('Debe seleccionar un grupo asignado primero.');
    }
}

    </script>

@endsection
@endrole





@role('Docente')

@auth
    @php
        $user = auth()->user();
    @endphp
@endauth

@section('content')
<h1 style="color:yellow">Registrar Clase</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <br>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'clase','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}
@csrf

<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
            <select class="form-control" style="color=#FFFFFF;" name="grupo_asignado" id="grupo_asignado">
                <option value="">Seleccione el grupo</option>
                @foreach($asignacionGrupos as $asigna)
                <option value="{{ $asigna->id }}">{{ $asigna->grupos->numero_grupo }} {{ $asigna->asignaturas->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
        <div class="form-group">
            <label for="persona" style="color:white;">Docente:</label>
            <input type="text" name="persona" id="persona" style="color:white;" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asignatura" style="color:white;">Asignatura:</label>
            <input type="text" name="asignatura" id="asignatura" style="color:white;" class="form-control" readonly>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="horario" style="color:white;">Horario:</label>
            <select class="form-control" style="color=#FFFFFF;" name="horario" id="horario">
                <option value="">Seleccione el horario</option>
                @foreach($horarios as $hora)
                <option value="{{ $hora->id }}">{{ $hora->hora_inicio }} - {{ $hora->hora_final }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="jornada" style="color:white;">Jornada:</label>
            <input type="text" name="jornada" id="jornada" style="color:white;" class="form-control" readonly>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="fecha" style="color:white;">Fecha:</label>
            <input class="form-control" type="date" name="fecha" id="fecha">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asistencia" style="color:white;">Asistencia:</label>
            <select class="form-control" style="color=#FFFFFF;" name="asistencia" id="asistencia">
                <option value="">Seleccione el estado de asistencia</option>
                <option value="asistida">Asistida</option>
                <option value="inasistida">Inasistida</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
    </div>
    <div class="row" id="observacion-container" style="display:none;">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="observacionClase" style="color:white;">Observación:</label>
                <textarea class="form-control"name="observacionClase" id="observacionClase" style="width: 100%; height: 150px;"></textarea>
            </div>
        </div>
    </div>

</div><div class="row" id="cargar-estudiantes-btn" style="display:none;">
    <div class="col-lg-12">
        <button class="btn btn-info" type="button" onclick="cargarEstudiantes()">Cargar Estudiantes</button>
    </div>
</div>
<br>
<!-- Contenedor para la lista de estudiantes -->
<div class="row" id="estudiantes-container" style="display:none;">
    <div class="col-lg-12">
        <h4 style="color:white;">Lista de Estudiantes</h4>
        <table class="table table-bordered table-hover" id="estudiantes-table">
            <thead>
                <tr>
                    <th style="color:white;">#</th>
                    <th style="color:white;">Nombre</th>
                    <th style="color:white;">Asistencia <input type="checkbox" id="asistencia-general"></th>
                    <th style="color:white;">Observaciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
<br>
<br>
<label style="color:white;">¿No encuentra su horario o aula?</label>
<br>
<a style="color:rgb(33, 222, 255);" target="_blank" href="{{route('horario.create')}}">Registrar Horario</a>
<br>
<a style="color:rgb(0, 217, 255);" target="_blank" href="{{route('aula.create')}}">Registrar Aula</a>

{!!Form::close()!!}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! Html::script('./js/metodos.js') !!}
<script>
    $(document).ready(function() {
        $('#asistencia').change(function() {
            var asistencia = $(this).val();

            // Mostrar el botón para cargar estudiantes si la asistencia es "asistida"
            if (asistencia == 'asistida') {
                $('#cargar-estudiantes-btn').show();
                $('#observacion-container').hide(); // Ocultar el campo de observación
            } else if (asistencia == 'inasistida') {
                $('#observacion-container').show(); // Mostrar el campo de observación
                $('#cargar-estudiantes-btn').hide(); // Ocultar el botón de cargar estudiantes
                $('#estudiantes-container').hide(); // Ocultar la tabla de estudiantes
            } else {
                $('#cargar-estudiantes-btn').hide(); // Ocultar ambos
                $('#observacion-container').hide();
                $('#estudiantes-container').hide();
            }
        });

            $('#asistencia-general').change(function() {
                var isChecked = $(this).is(':checked');
                $('#estudiantes-table tbody input[type="checkbox"]').prop('checked', isChecked);
            });

            $('#claseForm').submit(function(event) {
            var asistencia = $('#asistencia').val();
            var observacion = $('#observacion').val().trim();

            // Validar que el campo de observación no esté vacío si la asistencia es "inasistida"
            if (asistencia == 'inasistida' && observacion === '') {
                alert('Debe llenar el campo de observación para una clase inasistida.');
                event.preventDefault(); // Prevenir el envío del formulario si está vacío
            }
        });
    });

    function cargarEstudiantes() {
        var grupoId = $('#grupo_asignado').val();
        if (grupoId) {
            $.ajax({
                url: '{{ url('obtener-estudiantes') }}/' + grupoId,
                method: 'GET',
                success: function(response) {
                    var estudiantes = response.estudiantes;
                    var tbody = $('#estudiantes-table tbody');
                    var contador = 1;
                    tbody.empty();
                    estudiantes.forEach(function(estudiante) {
                        var row = `<tr>
                            <td>${contador}</td>
                            <td style="color:white;">${estudiante.nombres} ${estudiante.apellidos}</td>
                            <td>
                                <!-- Campo oculto para inasistencia -->
                                <input type="hidden" name="asistencia_estudiantes[${estudiante.id}]" value="0">
                                <!-- Checkbox para marcar asistencia -->
                                <input type="checkbox" name="asistencia_estudiantes[${estudiante.id}]" value="1">
                            </td>
                            <td><input type="text" name="observacion[${estudiante.id}]" class="form-control"></td>
                        </tr>`;
                        contador++;
                        tbody.append(row);
                    });
                    $('#estudiantes-container').show();
                }
            });
        } else {
            alert('Debe seleccionar un grupo asignado primero.');
        }
    }

        </script>
@endsection


@endrole
@role('Director')


@section('content')
<h1 style="color:yellow">Registrar Clase</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <br>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'clase','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}
@csrf

<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
            <select class="form-control" style="color=#FFFFFF;" name="grupo_asignado" id="grupo_asignado">
                <option value="">Seleccione el grupo</option>
                @foreach($asignacionGrupos as $asigna)
                <option value="{{ $asigna->id }}">{{ $asigna->grupos->numero_grupo }} {{ $asigna->asignaturas->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
        <div class="form-group">
            <label for="persona" style="color:white;">Docente:</label>
            <input type="text" name="persona" id="persona" style="color:white;" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asignatura" style="color:white;">Asignatura:</label>
            <input type="text" name="asignatura" id="asignatura" style="color:white;" class="form-control" readonly>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="horario" style="color:white;">Horario:</label>
            <select class="form-control" style="color=#FFFFFF;" name="horario" id="horario">
                <option value="">Seleccione el horario</option>
                @foreach($horarios as $hora)
                <option value="{{ $hora->id }}">{{ $hora->hora_inicio }} - {{ $hora->hora_final }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="jornada" style="color:white;">Jornada:</label>
            <input type="text" name="jornada" id="jornada" style="color:white;" class="form-control" readonly>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="fecha" style="color:white;">Fecha:</label>
            <input class="form-control" type="date" name="fecha" id="fecha">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asistencia" style="color:white;">Asistencia:</label>
            <select class="form-control" style="color=#FFFFFF;" name="asistencia" id="asistencia">
                <option value="">Seleccione el estado de asistencia</option>
                <option value="asistida">Asistida</option>
                <option value="inasistida">Inasistida</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
    </div>
    <div class="row" id="observacion-container" style="display:none;">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="observacionClase" style="color:white;">Observación:</label>
                <textarea class="form-control"name="observacionClase" id="observacionClase" style="width: 100%; height: 150px;"></textarea>
            </div>
        </div>
    </div>

</div><div class="row" id="cargar-estudiantes-btn" style="display:none;">
    <div class="col-lg-12">
        <button class="btn btn-info" type="button" onclick="cargarEstudiantes()">Cargar Estudiantes</button>
    </div>
</div>
<br>
<!-- Contenedor para la lista de estudiantes -->
<div class="row" id="estudiantes-container" style="display:none;">
    <div class="col-lg-12">
        <h4 style="color:white;">Lista de Estudiantes</h4>
        <table class="table table-bordered table-hover" id="estudiantes-table">
            <thead>
                <tr>
                    <th style="color:white;">#</th>
                    <th style="color:white;">Nombre</th>
                    <th style="color:white;">Asistencia <input type="checkbox" id="asistencia-general"></th>
                    <th style="color:white;">Observaciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
<br>
<br>
<label style="color:white;">¿No encuentra su horario o aula?</label>
<br>
<a style="color:rgb(33, 222, 255);" target="_blank" href="{{route('horario.create')}}">Registrar Horario</a>
<br>
<a style="color:rgb(0, 217, 255);" target="_blank" href="{{route('aula.create')}}">Registrar Aula</a>

{!!Form::close()!!}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! Html::script('./js/metodos.js') !!}
<script>
    $(document).ready(function() {
        $('#asistencia').change(function() {
            var asistencia = $(this).val();

            // Mostrar el botón para cargar estudiantes si la asistencia es "asistida"
            if (asistencia == 'asistida') {
                $('#cargar-estudiantes-btn').show();
                $('#observacion-container').hide(); // Ocultar el campo de observación
            } else if (asistencia == 'inasistida') {
                $('#observacion-container').show(); // Mostrar el campo de observación
                $('#cargar-estudiantes-btn').hide(); // Ocultar el botón de cargar estudiantes
                $('#estudiantes-container').hide(); // Ocultar la tabla de estudiantes
            } else {
                $('#cargar-estudiantes-btn').hide(); // Ocultar ambos
                $('#observacion-container').hide();
                $('#estudiantes-container').hide();
            }
        });

            $('#asistencia-general').change(function() {
                var isChecked = $(this).is(':checked');
                $('#estudiantes-table tbody input[type="checkbox"]').prop('checked', isChecked);
            });

            $('#claseForm').submit(function(event) {
            var asistencia = $('#asistencia').val();
            var observacion = $('#observacion').val().trim();

            // Validar que el campo de observación no esté vacío si la asistencia es "inasistida"
            if (asistencia == 'inasistida' && observacion === '') {
                alert('Debe llenar el campo de observación para una clase inasistida.');
                event.preventDefault(); // Prevenir el envío del formulario si está vacío
            }
        });
    });

    function cargarEstudiantes() {
        var grupoId = $('#grupo_asignado').val();
        if (grupoId) {
            $.ajax({
                url: '{{ url('obtener-estudiantes') }}/' + grupoId,
                method: 'GET',
                success: function(response) {
                    var estudiantes = response.estudiantes;
                    var tbody = $('#estudiantes-table tbody');
                    var contador = 1;
                    tbody.empty();
                    estudiantes.forEach(function(estudiante) {
                        var row = `<tr>
                            <td>${contador}</td>
                            <td style="color:white;">${estudiante.nombres} ${estudiante.apellidos}</td>
                            <td>
                                <!-- Campo oculto para inasistencia -->
                                <input type="hidden" name="asistencia_estudiantes[${estudiante.id}]" value="0">
                                <!-- Checkbox para marcar asistencia -->
                                <input type="checkbox" name="asistencia_estudiantes[${estudiante.id}]" value="1">
                            </td>
                            <td><input type="text" name="observacion[${estudiante.id}]" class="form-control"></td>
                        </tr>`;
                        contador++;
                        tbody.append(row);
                    });
                    $('#estudiantes-container').show();
                }
            });
        } else {
            alert('Debe seleccionar un grupo asignado primero.');
        }
    }

        </script>
@endsection
@endrole
