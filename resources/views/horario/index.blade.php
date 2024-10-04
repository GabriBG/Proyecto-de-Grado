@extends('layouts.app', ['page' => ('Horarios'),'pageSlug' => 'indexH'])
@role('Docente')
@section('content')
<h1>Horario</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Jornada</th>
<th>Hora de Inicio</th>
<th>Hora de Final</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('horario.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar horario"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($horarios as $hora)
<tr>
<td>{{ $hora->id }}</td>
<td>{{ $hora->jornada }}</td>
<td>{{ $hora->hora_inicio }}</td>
<td>{{ $hora->hora_final}}</td>
<td>


</a>
</td>
</tr>
@endforeach

</tbody> </table>
</div></div>
<div class="row">
<div class="col-md-9">
 </div></div>
@endsection
@endrole


@section('content')
<h1>Horario</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Jornada</th>
<th>Hora de Inicio</th>
<th>Hora de Final</th>
  <th>Opciones</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('horario.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar horario"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($horarios as $hora)
<tr>
<td>{{ $hora->id }}</td>
<td>{{ $hora->jornada }}</td>
<td>{{ $hora->hora_inicio }}</td>
<td>{{ $hora->hora_final}}</td>
<td>
<a href="{{url('horario/'.$hora->id.'/edit')}}" ><button class="btn btn-info">Actualizar</button></a>
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$hora->id}}">
    <i >Eliminar</i>
  </button>

</a>
</td>
</tr>
    @include('horario.modal')
@endforeach
@if(Session::has('mensaje'))
<div class="alert alert-success alert" role="alert">
{{ Session::get('mensaje')}}
</div>
@endif
</tbody> </table>
</div></div>
<div class="row">
<div class="col-md-9">
<a href="{{url('horario/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear Horario</button> </a> </div></div>
@endsection

