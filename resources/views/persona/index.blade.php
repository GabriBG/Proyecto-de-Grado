@extends('layouts.app', ['pageSlug' => 'indexP'])

@section('content')


<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Documento Identidad</th>
<th>Nombres Completos</th>
<th>Apellidos</th>
<th>Correo Electrónico</th>
 <th>Telefono</th>
  <th>Opciones</th>
</thead>
<tbody>
@foreach($personas as $per)
<tr>
<td>{{ $per->id }}</td>
<td>{{ $per->documento_identidad }}</td>
<td>{{ $per->nombre }}</td>
<td>{{ $per->apellido}}</td>
<td>{{ $per->users->email }}</td>
<td>{{ $per->telefono }}</td>
<td>
<a href="{{url('persona/'.$per->id.'/edit')}}" ><button class="btn btn-primary">Actualizar</button></a>
<a href="" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$per->id}}">
    <button type="button" class="btn btn-danger"> Eliminar</button>
</a>
</td>
</tr>
@include('persona.modal')
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
<a href="{{url('persona/create')}}" class="pull-left">
<button class="btn btn-success">Crear Persona</button> </a> </div></div>
@endsection
