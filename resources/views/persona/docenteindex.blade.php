@extends('layouts.app', ['pageSlug' => 'indexD'])

@section('content')

<h1>Docentes</h1>


<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Documento Identidad</th>
<th>Nombres Completos</th>
<th>Apellidos</th>
<th>Correo Electrónico</th>
 <th>Telefono</th>
 <th>Rol</th>
  <th>Opciones</th>
</thead>
<tbody>
  <form class="card card-header" action="{{ route('docente.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Docente"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($personas as $per)
<tr>
<td>{{ $per->id }}</td>
<td>{{ $per->documento_identidad }}</td>
<td>{{ $per->nombre }}</td>
<td>{{ $per->apellido}}</td>
<td>{{ $per->users->email }}</td>
<td>{{ $per->telefono }}</td>
<td>{{ $per->users->roles->pluck('name')->implode(', ') }}</td>

<td>
<a href="{{url('persona/'.$per->id.'/edit')}}"><button class="btn btn-info">Actualizar</button></a>
<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$per->id}}">
  <i >Eliminar</i>
</button>

</a>
</td>
</tr>
    @include('docente.modal')
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
<a href="{{url('persona/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear Persona</button> </a> </div></div>
<a href="{{url('imprimirPersonas')}}" target="_blank" class="pull-right">
    <button class="btn btn-success">Imprimir PDF</button></a></div>
@endsection
