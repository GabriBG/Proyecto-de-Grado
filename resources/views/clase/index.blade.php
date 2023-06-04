@extends('layouts.app', ['page' => ('Clases'), 'pageSlug' => 'indexC'])

@section('content')


<h1>Clases Registradas</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Docente</th>
<th>Asignatura</th>
<th>Numero de Grupo</th>
<th>Horario</th>
  <th>Opciones</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('clase.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Clases"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
<br>
@foreach($clases as $cla)
<tr>
<td>{{ $cla->id }}</td>
<td>{{ $cla->asignacionGrupos->personas->nombre }} {{ $cla->asignacionGrupos->personas->apellido }}</td>
<td>{{ $cla->asignacionGrupos->asignaturas->nombre }}</td>
<td>{{ $cla->asignacionGrupos->grupos->numero_grupo}}</td>
<td>{{ $cla->horarios->hora_inicio}} - {{ $cla->horarios->hora_final}}</td>
<td>

<a href="{{url('clase/'.$cla->id.'/examinar')}}"><button class="btn btn-close">Examinar</button></a>
<a href="{{url('clase/'.$cla->id.'/edit')}}"><button class="btn btn-info">Actualizar</button></a>
<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$cla->id}}">
  <i >Eliminar</i>
</buttom>

</a>
</td>
</tr>
@include('clase.modal')
@endforeach

@if(Session::has('mensaje'))
<div class="alert alert-success alert" role="alert">
{{ Session::get('mensaje')}}
</div>
@endif
</tbody> </table>
</div>
<div class="row">
<div class="col-md-9">
<a href="{{url('clase/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear nueva clase</button> </a> </div></div>
<a target="_blank" href="{{ route('imprimirClase', ['name' => request('name')]) }}">
    <button class="btn btn-success"  value="PDF" type="submit">Generar PDF</button></a></div>
@endsection
