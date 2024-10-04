    @extends('layouts.app', ['page' => ('Grupos'),'pageSlug' => 'indexG'])

    @section('content')
    <h1>Grupo</h1>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Id</th>
                    <th>Estudiantes Matriculados</th>
                    <th>Numero Grupo</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <form class="card card-header" action="{{ route('grupo.index') }}" method="get">
                        <input name="name" id='name' value="{{ old('name') }}" type="text" aria-label="Search" class="form-control" placeholder="Buscar Grupo">
                        <br>
                        <input class="btn btn-info" type="submit" value="Buscar">
                    </form>
                    @foreach($grupos as $gru)
                    <tr>
                        <td>{{ $gru->id }}</td>
                        <td>{{ $gru->estudiantes_matriculados }}</td>
                        <td>{{ $gru->numero_grupo }}</td>
                        <td>
                            <!-- Solo Admin y Director pueden ver los botones de actualizar y eliminar -->
                            @role('Admin|Director')
                                <a href="{{ url('grupo/'.$gru->id.'/edit') }}"><button class="btn btn-info">Actualizar</button></a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$gru->id}}">
                                    <i >Eliminar</i>
                                </button>
                            @endrole

                            <!-- Todos los roles pueden ver estudiantes -->
                            <button type="button" class="btn btn-secundary" data-toggle="collapse" data-target="#estudiantes-{{ $gru->id }}" aria-expanded="false" aria-controls="estudiantes-{{ $gru->id }}">
                                Ver Estudiantes
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div id="estudiantes-{{ $gru->id }}" class="collapse">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        @role('Admin|Director')
                                        <th>Acciones</th>
                                        @endrole
                                    </thead>
                                    <tbody>
                                        @php
                                            $estudiantes = \App\Models\Estudiante::where('id_grupo', $gru->id)->get();
                                            $contador = 1;
                                        @endphp
                                        @forelse($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ $contador++ }}</td>
                                            <td>{{ $estudiante->nombres }}</td>
                                            <td>{{ $estudiante->apellidos }}</td>
                                            @role('Admin|Director')
                                            <td><a target="_blank" href="{{ route('reporte.estudiante', $estudiante->id) }}" class="btn btn-info">
                                                Reporte
                                            </a></td>
                                            @endrole

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No hay estudiantes registrados en este grupo.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if(Session::has('mensaje'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('mensaje') }}
                    </div>
                    @endif
                </tbody>
            </table>
        </div>
            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $grupos->links() }}
            </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <!-- Solo Admin y Director pueden crear grupos -->
            @role('Admin|Director')
                <a href="{{ url('grupo/create') }}" class="pull-left">
                    <button class="btn btn-neutral btn-info">Crear Grupo</button>
                </a>
            @endrole
        </div>
    </div>
    @endsection
