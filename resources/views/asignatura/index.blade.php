@extends('layout.plantilla')
@section('titulo') AppDev-Persona 
@endsection

@section('contenidoPrincipal')

<div class="row">
<div class="col-md-9">
<a href="{{url('asignatura/create')}}" class="pull-right">
<button class="btn btn-success">Crear Asignatura</button> </a> </div></div>
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
@foreach($asignaturas as $per)
<tr>
<td>{{ $per->id }}</td>
<td>{{ $per->codigo }}</td>
<td>{{ $per->nombre }}</td>
<td>{{ $per->creditos}}</td>
<td>
<a href=""><button class="btn btn-primary">Actualizar</button></a> 
<a href="" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$per->id}}"> 
    <button type="button" class="btn btn-danger"> Eliminar</button>
</a>
</td>
</tr> 
@include('asignatura.modal')

@endforeach
</tbody> </table>
</div></div>
@endsection
