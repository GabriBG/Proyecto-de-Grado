@extends('layouts.app', ['page' => ('Grupos'), 'pageSlug' => 'grupos'])

@section('content')
<h1>Editar Grupo</h1>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h4>Editar Grupo</h4>
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
<form action="{{ route('grupo.update', $grupo->id) }}" method="post" id="grupoForm">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Estudiantes Matriculados</label>
                <select class="form-control" style="color=#FFFFFF;" name="estudiantes_matriculados" id="estudiantes_matriculados">
                    @for($i = 1; $i <= 50; $i++)
                        <option value="{{ $i }}" {{ ($grupo->estudiantes_matriculados == $i) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Numero de grupo</label>
                <input type="text" name="numero_grupo" value="{{ $grupo->numero_grupo }}" id="numero_grupo" class="form-control" placeholder="Numero de grupo">
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
            <div class="form-group">
                <br>
                <button type="button" class="btn btn-primary" id="cargarEstudiantesBtn">Cargar estudiantes</button>
            </div>
        </div>
    </div>
    <div id="tablaEstudiantesContainer" class="row">
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
                    @foreach($grupo->estudiantes as $index => $estudiante)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" name="estudiantes_nombres[]" value="{{ $estudiante->nombres }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="estudiantes_apellidos[]" value="{{ $estudiante->apellidos }}" class="form-control">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
        <div class="form-group">
            <br>
            <button class="btn btn-info" type="submit" id="guardarBtn"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
            <a class="btn btn-danger" href="{{ route('grupo.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>
        </div>
    </div>
</form>

<script>
    var estudiantesNombres = @json($grupo->estudiantes->pluck('nombres'));
    var estudiantesApellidos = @json($grupo->estudiantes->pluck('apellidos'));

    document.addEventListener('DOMContentLoaded', function() {
        cargarEstudiantes();
        document.getElementById('tablaEstudiantesContainer').style.display = 'block';
    });

    document.getElementById('cargarEstudiantesBtn').addEventListener('click', function() {
        cargarEstudiantes();
    });

    function cargarEstudiantes() {
        var numEstudiantes = document.getElementById('estudiantes_matriculados').value;
        var tabla = document.getElementById('tablaEstudiantes').getElementsByTagName('tbody')[0];
        var tempNombres = [];
        var tempApellidos = [];

        // Recoger los valores actuales de los inputs
        tabla.querySelectorAll('tr').forEach(function(row) {
            tempNombres.push(row.cells[1].querySelector('input').value);
            tempApellidos.push(row.cells[2].querySelector('input').value);
        });

        // Actualizar los arreglos con los valores temporales si son mayores
        for (var i = 0; i < tempNombres.length; i++) {
            estudiantesNombres[i] = tempNombres[i];
            estudiantesApellidos[i] = tempApellidos[i];
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
            inputNombre.value = estudiantesNombres[i] ? estudiantesNombres[i] : '';
            cellInputNombre.appendChild(inputNombre);

            var inputApellido = document.createElement('input');
            inputApellido.type = 'text';
            inputApellido.name = 'estudiantes_apellidos[]';
            inputApellido.className = 'form-control';
            inputApellido.value = estudiantesApellidos[i] ? estudiantesApellidos[i] : '';
            cellInputApellido.appendChild(inputApellido);
        }
    }

    document.getElementById('grupoForm').addEventListener('submit', function(event) {
        var tabla = document.getElementById('tablaEstudiantes').getElementsByTagName('tbody')[0];
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

        if (!valid) {
            alert(errorMsg);
            event.preventDefault();
        }
    });
</script>
@endsection
