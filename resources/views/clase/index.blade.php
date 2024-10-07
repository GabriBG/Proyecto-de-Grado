@extends('layouts.app', ['page' => ('Clases'), 'pageSlug' => 'indexC'])
@section('content')

<h1>Clases Registradas</h1>

<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <th>Id</th>
                <th>Docente</th>
                <th>Asignatura</th>
                <th>Numero de Grupo</th>
                <th>Horario</th>
                <th>Estado</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <form class="card card-header" action="{{ route('clase.index') }}" method="get">
                    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Clases">
                    <br>
                    <input class="btn btn-info" type="submit" value="Buscar">
                </form>
                <br>
                @foreach($clases as $cla)
                @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Director') || (auth()->user()->hasRole('Docente') && $cla->asignacionGrupos->personas->id_usuario == auth()->user()->id))

                        <tr>
                            <td>{{ $cla->id }}</td>
                            <td>{{ $cla->asignacionGrupos->personas->nombre }} {{ $cla->asignacionGrupos->personas->apellido }}</td>
                            <td>{{ $cla->asignacionGrupos->asignaturas->nombre }}</td>
                            <td>{{ $cla->asignacionGrupos->grupos->numero_grupo }}</td>
                            <td>{{ $cla->horarios->hora_inicio }} - {{ $cla->horarios->hora_final }}</td>
                            <td>{{ ucfirst($cla->asistencia) }}</td>
                            <td>
                                <a href="{{ url('clase/'.$cla->id.'/examinar') }}"><button class="btn btn-close">Examinar</button></a>
                                @can('delete', $cla)
                                <a target="_blank" href="{{ url('reporteClasePDF/'.$cla->id) }}"><button class="btn btn-info">Reporte</button></a>
                                @endcan
                                @can('update', $cla)
                                    <a href="{{ url('clase/'.$cla->id.'/edit') }}"><button class="btn btn-info">Actualizar</button></a>
                                @endcan

                                @can('delete', $cla)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$cla->id}}">
                                        <i>Eliminar</i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                        @include('clase.modal')
                    @endif
                @endforeach

                @if(Session::has('mensaje'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif
            </tbody>
        </table>
        <!-- Paginador -->
        <div class="d-flex justify-content-center">
            {{ $clases->links() }}
        </div>
    </div>
</div>

<!-- Opciones adicionales para Admin y Director -->
@canany(['create', 'generatePdf'], App\Models\Clase::class)
    <div class="row">
        <div class="col-md-9">
            <a href="{{ url('clase/create') }}" class="pull-left">
                <button class="btn btn-neutral btn-info">Crear nueva clase</button>
            </a>


    <a target="_blank" href="{{ route('imprimirClase', ['name' => request('name')]) }}">
        <button class="btn btn-success">Generar PDF</button>
    </a>
</div>
    </div>
@endcanany

@endsection
