@extends('layouts.app', ['pageSlug' => 'indexH'])


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
@foreach($horarios as $hora)
<tr>
<td>{{ $hora->id }}</td>
<td>{{ $hora->jornada }}</td>
<td>{{ $hora->hora_inicio }}</td>
<td>{{ $hora->hora_final}}</td>
<td>
<a href="{{url('horario/'.$hora->id.'/edit')}}" ><button class="btn btn-info">Actualizar</button></a>
<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$hora->id}}">
  <i >Eliminar</i>
</buttom>

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
<button class="btn btn-neutral btn-info">Crear Persona</button> </a> </div></div>
@endsection
