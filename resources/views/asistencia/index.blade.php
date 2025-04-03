
@extends('layouts.app', ['page' => 'Asistencias', 'pageSlug' => 'indexA'])
@role('Admin|Director')
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
        <!-- Filtro por asistencia (asistida o no asistida) -->
        <div class="col-md-3">
            <select name="estado_asistencia" id="estado_asistencia" class="form-control">
                <option value="">Estado de Asistencia</option>
                <option value="1">Asistida</option>
                <option value="0">No asistida</option>
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
                            <button target="_blank" class="btn btn-success" type="button">Generar PDF</button>
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
                                No asistida
                                @endif
                            </td>
                            <td>{{ $asistencia->clase->horarios->hora_inicio }} - {{ $asistencia->clase->horarios->hora_final }}</td>
                            <td>
                                @if($asistencia->observacion)
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-ver-{{$asistencia->id}}">
                                        Ver Observación
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Incluir el modal -->
            @include('asistencia.modal')

            <!-- Paginador -->
            <div class="d-flex justify-content-center">
                {!! $asistencias->onEachSide(1)->links('vendor.pagination.bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
@endrole

<style>.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 10px;
}

.page-item {
    list-style: none;
}

.page-link {
    padding: 12px 18px;
    font-size: 18px;
    font-weight: bold;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.page-link:hover {
    background-color: #0056b3;
    transform: scale(1.1);
}

.page-item.active .page-link {
    background-color: #ff4081;
    color: white;
    transform: scale(1.2);
}
</style>
