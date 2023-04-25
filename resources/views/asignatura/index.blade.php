@extends('layouts.app', ['pageSlug' => 'indexA'])

@section('content')




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
<a href="{{url('asignatura/'.$asi->id.'/edit')}}"><button class="btn btn-primary">Actualizar</button></a>
<a href="" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$asi->id}}">
    <button type="button" class="btn btn-danger"> Eliminar</button>
</a>
</td>
</tr>
@include('asignatura.modal')

@endforeach
</tbody> </table>
</div></div>
<div class="row">
<div class="col-md-9">
<a href="{{url('asignatura/create')}}" class="pull-left">
<button class="btn btn-success">Crear Asignatura</button> </a> </div></div>
@endsection
