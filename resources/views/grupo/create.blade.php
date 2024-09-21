@extends('layouts.app', ['page' => ('Grupos'), 'pageSlug' => 'crearG'])

@section('content')
<h1>Grupo</h1>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h4>Ingresar Grupo</h4>
        @if (count($errors) > 0)
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

{!! Form::open(['url' => 'grupo', 'method' => 'POST', 'autocomplete' => 'off', 'id' => 'grupoForm']) !!}
{{ Form::token() }}

<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Estudiantes Matriculados</label>
            <select class="form-control" style="color=#FFFFFF;" name="estudiantes_matriculados" id="estudiantes_matriculados">
                <option class="" value="1">1</option>
                @for($i = 2; $i <= 50; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Numero de grupo</label>
            <input type="text" name="numero_grupo" value="{{ old('numero_grupo') }}" id="numero_grupo" class="form-control" placeholder="Numero de grupo">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
        <div class="form-group">
            <br>
            <button type="button" class="btn btn-primary" id="cargarEstudiantesBtn">Cargar estudiantes</button>
        </div>
    </div>
</div>
<div id="tablaEstudiantesContainer" class="row" style="display:none;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table" id="tablaEstudiantes">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombres de Estudiantes</th>
                    <th>Apellidos de Estudiantes</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
        <div class="form-group">
            <br>
            <button class="btn btn-info" type="submit" id="guardarBtn"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
            <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
        </div>
    </div>
</div>

{!! Form::close() !!}

<script>
    document.getElementById('cargarEstudiantesBtn').addEventListener('click', function() {
        var numEstudiantes = document.getElementById('estudiantes_matriculados').value;
        var tablaContainer = document.getElementById('tablaEstudiantesContainer');
        var tabla = document.getElementById('tablaEstudiantes').getElementsByTagName('tbody')[0];
        var currentRows = tabla.querySelectorAll('tr').length;

        if (currentRows > numEstudiantes) {
            if (!confirm("El número de estudiantes matriculados es menor que el número actual de estudiantes. Se eliminarán los registros sobrantes. ¿Desea continuar?")) {
                return;
            }
        }

        tabla.innerHTML = ''; // Limpiar la tabla antes de agregar nuevas filas

        for (var i = 0; i < numEstudiantes; i++) {
            var row = tabla.insertRow(i);
            var cellIndex = row.insertCell(0);
            var cellInputNombre = row.insertCell(1);
            var cellInputApellido = row.insertCell(2);

            cellIndex.textContent = i + 1;

            var inputNombre = document.createElement('input');
            inputNombre.type = 'text';
            inputNombre.name = 'estudiantes_nombres[]';
            inputNombre.className = 'form-control';
            cellInputNombre.appendChild(inputNombre);

            var inputApellido = document.createElement('input');
            inputApellido.type = 'text';
            inputApellido.name = 'estudiantes_apellidos[]';
            inputApellido.className = 'form-control';
            cellInputApellido.appendChild(inputApellido);
        }

        tablaContainer.style.display = 'block';
    });

    document.getElementById('grupoForm').addEventListener('submit', function(event) {
        var numEstudiantesMatriculados = document.getElementById('estudiantes_matriculados').value;
        var tabla = document.getElementById('tablaEstudiantes').getElementsByTagName('tbody')[0];
        var numEstudiantesRegistrados = tabla.querySelectorAll('tr').length;
        var valid = true;
        var errorMsg = '';

        tabla.querySelectorAll('tr').forEach(function(row, index) {
            var nombre = row.cells[1].querySelector('input').value;
            var apellido = row.cells[2].querySelector('input').value;
            if (!nombre || !apellido) {
                valid = false;
                errorMsg += 'Falta el nombre o apellido del estudiante ' + (index + 1) + '\n';
            }
        });

        if (numEstudiantesMatriculados != numEstudiantesRegistrados) {
            valid = false;
            errorMsg += 'El número de estudiantes matriculados no coincide con el número de estudiantes registrados.\n';
        }

        if (!valid) {
            alert(errorMsg);
            event.preventDefault();
        }
    });
</script>
@endsection
