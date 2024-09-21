
@extends('layouts.app', ['page' => 'Asistencias', 'pageSlug' => 'indexA'])
@role('Admin')
@section('content')
    <h1>Asistencias Registradas</h1>

    <div class="row">
        <div class="table-responsive">
            <!-- Filtros -->
            <form class="card card-header" action="{{ route('asistencia.index') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <input name="asignatura" id='asignatura' type="text" class="form-control" placeholder="Buscar Asignatura">
                    </div>
                    <div class="col-md-3">
                        <input name="docente" id='docente' type="text" class="form-control" placeholder="Buscar Docente">
                    </div>
                    <div class="col-md-3">
                        <input name="fecha_clase" id="fecha_clase" type="date" class="form-control" placeholder="Fecha de Clase">
                    </div>
                    <div class="col-md-3">
                        <input name="grupo" id="grupo" type="text" class="form-control" placeholder="Buscar Grupo">
                    </div>
                </div>

                <div class="row mt-3">
                    <!-- Filtro por estudiante -->
                    <div class="col-md-3">
                        <input name="estudiante" id="estudiante" type="text" class="form-control" placeholder="Buscar Estudiante">
                    </div>

                    <!-- Filtro por horario -->
                    <div class="col-md-3">
                        <select name="horario" id="horario" class="form-control">
                            <option value="">Seleccionar Horario</option>
                            @foreach ($horarios as $horario)
                                <option value="{{ $horario->id }}">
                                    {{ $horario->hora_inicio }} - {{ $horario->hora_final }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón de buscar -->
                    <div class="col-md-3">
                        <input class="btn btn-info" type="submit" value="Buscar">
                        <a href="{{ route('asistencia.index') }}" class="btn btn-secondary">Reiniciar Filtros</a>
                    </div>

                    <!-- Generar PDF -->
                    <div class="col-md-3">
                        <a target="_blank" href="{{ route('imprimirAsistencia', request()->query()) }}">
                            <button class="btn btn-success" type="button">Generar PDF</button>
                        </a>
                    </div>
                </div>
            </form>
            <br>

            <!-- Tabla de asistencias -->
            <table class="table table-striped table-hover">
                <thead>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Grupo</th>
                    <th>Docente</th>
                    <th>Asignatura</th>
                    <th>Fecha</th>
                    <th>Estado de Asistencia</th>
                    <th>Horario</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach($asistencias as $asistencia)
    <tr>
        <td>{{ $asistencia->id }}</td>
        <td>{{ $asistencia->estudiante->nombres }} {{ $asistencia->estudiante->apellidos }}</td>
        <td>{{ $asistencia->clase->grupos->numero_grupo }}</td>
        <td>{{ $asistencia->clase->personas->nombre }} {{ $asistencia->clase->personas->apellido }}</td>
        <td>{{ $asistencia->clase->asignaturas->nombre }}</td>
        <td>{{ $asistencia->created_at->format('d-m-Y') }}</td>
        <td>
            @if($asistencia->asistencia == 1)
                Asistida
            @else
                Inasistida
            @endif
        </td>
        <td>{{ $asistencia->clase->horarios->hora_inicio }} - {{ $asistencia->clase->horarios->hora_final }}</td>
        <td>
<!-- Botón que abre el modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-ver-{{$asistencia->id}}">
    Eliminar
</button>

</div>
        </td>
    </tr>
    @include('asistencia.modal')
@endforeach
@if(Session::has('mensaje'))
<div class="alert alert-success alert" role="alert">
{{ Session::get('mensaje')}}
</div>
@endif
                </tbody>
            </table>

            <!-- Inicio del Paginador -->
            <div class="d-flex justify-content-center">
                {{ $asistencias->links() }}
            </div>
            <!-- Fin del Paginador -->
        </div>
    </div>
@endsection
@endrole
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
