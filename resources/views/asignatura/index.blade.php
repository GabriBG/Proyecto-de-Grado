@extends('layouts.app', ['page' => ('Asignaturas'),'pageSlug' => 'indexA'])
@role('Docente')
@section('content')


<h1>Asignatura</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Codigo</th>
<th>Nombre</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('asignatura.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Asignatura"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($asignaturas as $asi)
<tr>
<td>{{ $asi->id }}</td>
<td>{{ $asi->codigo }}</td>
<td>{{ $asi->nombre }}</td>
<td>




</a>
</td>
</tr>

@endforeach

</tbody> </table>
<!-- Inicio del Paginador -->
<div class="d-flex justify-content-center">
    {{ $asignaturas->links() }}
</div>
<!-- Fin del Paginador -->
</div>
<div class="row">
<div class="col-md-9">
</div></div>
</div>
@endsection
@endrole




@section('content')


<h1>Asignatura</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Codigo</th>
<th>Nombre</th>
  <th>Opciones</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('asignatura.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Asignatura"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($asignaturas as $asi)
<tr>
<td>{{ $asi->id }}</td>
<td>{{ $asi->codigo }}</td>
<td>{{ $asi->nombre }}</td>
<td>
<a href="{{url('asignatura/'.$asi->id.'/edit')}}"><button class="btn btn-info">Actualizar</button></a>

<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$asi->id}}">
    <i >Eliminar</i>
  </button>


</a>
</td>
</tr>
@include('asignatura.modal')
@endforeach

@if(Session::has('mensaje'))
<div class="alert alert-success alert" role="alert">
{{ Session::get('mensaje')}}
</div>
@endif
</tbody> </table>
<!-- Inicio del Paginador -->
<div class="d-flex justify-content-center">
    {{ $asignaturas->links() }}
</div>
<!-- Fin del Paginador -->
</div>
<div class="row">
<div class="col-md-9">
<a href="{{url('asignatura/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear Asignatura</button> </a> </div></div>
<a target="_blank" href="{{ route('imprimirAsignaturas', ['name' => request('name')]) }}">
    <button class="btn btn-success"  value="PDF" type="submit">Generar PDF</button></a></div>
@endsection

