@extends('layouts.app', ['pageSlug' => 'indexA'])

@section('content')


<h1>Asignatura</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Codigo</th>
<th>Nombre</th>
<th>Creditos</th>
  <th>Opciones</th>
</thead>
<tbody>
@foreach($asignaturas as $asi)
<tr>
<td>{{ $asi->id }}</td>
<td>{{ $asi->codigo }}</td>
<td>{{ $asi->nombre }}</td>
<td>{{ $asi->creditos}}</td>
<td>
<a href="{{url('asignatura/'.$asi->id.'/edit')}}"><button class="btn btn-info">Actualizar</button></a>

<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$asi->id}}">
  <i >Eliminar</i>
</buttom>

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
</div></div>
<div class="row">
<div class="col-md-9">
<a href="{{url('asignatura/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear Asignatura</button> </a> </div></div>
@endsection
