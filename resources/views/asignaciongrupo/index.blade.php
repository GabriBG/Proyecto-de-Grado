@extends('layouts.app', ['page' => ('Asignacion Grupos'), 'pageSlug' => 'indexAG'])

@section('content')

@php
    $user = auth()->user();
    $role = $user->roles->pluck('name')->first(); // Obteniendo el rol del usuario
@endphp

<h1>Grupos Asignados</h1>

<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <th>Id</th>
                <th>Docente</th>
                <th>Asignatura</th>
                <th>Numero de Grupo</th>
                <th>Aula</th>
                <th>Sede</th>
                @if($role == 'Admin' || $role == 'Director')
                    <th>Opciones</th>
                @endif
            </thead>
            <tbody>
                <!-- Formulario de búsqueda -->
                <form class="card card-header" action="{{ route('asignaciongrupo.index') }}" method="get">
                    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Grupos Asignados"></input>
                    <br>
                    <input class="btn btn-info" type="submit" value="Buscar">
                </form>

                <!-- Listado de asignaciones -->
                @foreach($asignacion_grupos as $asigna)
                    <!-- Mostrar asignaciones solo si es docente del grupo o es Admin/Director -->
                    @if($role == 'Admin' || $role == 'Director' || ($role == 'Docente' && $asigna->personas->id_usuario == $user->id))
                        <tr>
                            <td>{{ $asigna->id }}</td>
                            <td>{{ $asigna->personas->nombre }} {{ $asigna->personas->apellido }}</td>
                            <td>{{ $asigna->asignaturas->nombre }}</td>
                            <td>{{ $asigna->grupos->numero_grupo }}</td>
                            <td>{{ $asigna->aula }}</td>
                            <td>{{ $asigna->sede }}</td>

                            @if($role == 'Admin' || $role == 'Director')
                                <td>
                                    <a href="{{ url('asignaciongrupo/'.$asigna->id.'/edit') }}">
                                        <button class="btn btn-info">Actualizar</button>
                                    </a>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$asigna->id}}">
                                        <i>Eliminar</i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @include('asignaciongrupo.modal')
                    @endif
                @endforeach

                @if(Session::has('mensaje'))
                    <div class="alert alert-success alert" role="alert">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $asignacion_grupos->links() }}
    </div>

    <!-- Opciones adicionales para Admin y Director -->
    @if($role == 'Admin' || $role == 'Director')
        <div class="row">
            <div class="col-md-9">
                <a href="{{ url('asignaciongrupo/create') }}" class="pull-left">
                    <button class="btn btn-neutral btn-info">Asignar nuevo grupo</button>
                </a>
            </div>
        </div>
        <a target="_blank" href="{{ route('imprimirAsignacion', ['name' => request('name')]) }}">
            <button class="btn btn-success" value="PDF" type="submit">Generar PDF</button>
        </a>
    @endif
</div>

@endsection
