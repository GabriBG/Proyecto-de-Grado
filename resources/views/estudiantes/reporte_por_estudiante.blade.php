@extends('layouts.app', ['page' => ('Docentes'),'pageSlug' => 'crearP'])

@section('content')
<div class="container">
    <h2>Reporte por Estudiante</h2>
    @foreach($grupos as $grupo)
        <div class="card mb-3">
            <div class="card-header">
                Grupo: {{ $grupo->nombre }}
            </div>
            <div class="card-body">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#grupo-{{ $grupo->id }}">
                    Ver Estudiantes
                </button>
                <div id="grupo-{{ $grupo->id }}" class="collapse mt-3">
                    <ul class="list-group">
                        @foreach($grupo->estudiantes as $estudiante)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $estudiante->nombre }} {{ $estudiante->apellido }}
                                <a href="{{ route('reporte.estudiante', $estudiante->id) }}" class="btn btn-info">Reporte</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
