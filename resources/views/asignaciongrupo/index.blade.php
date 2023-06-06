@extends('layouts.app', ['page' => ('Asignacion Grupos'),'pageSlug' => 'indexAG'])
@role('Admin')
@section('content')


<h1>Grupos Asignados</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Docente</th>
<th>Asignatura</th>
<th>Numero de Grupo</th>
  <th>Opciones</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('asignaciongrupo.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Grupos Asignados"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($asignacion_grupos as $asigna)
<tr>
<td>{{ $asigna->id }}</td>
<td>{{ $asigna->personas->nombre }} {{ $asigna->personas->apellido }}</td>
<td>{{ $asigna->asignaturas->nombre }}</td>
<td>{{ $asigna->grupos->numero_grupo}}</td>
<td>
<a href="{{url('asignaciongrupo/'.$asigna->id.'/edit')}}"><button class="btn btn-info">Actualizar</button></a>

<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$asigna->id}}">
  <i >Eliminar</i>
</buttom>

</a>
</td>
</tr>
@include('asignaciongrupo.modal')
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
<a href="{{url('asignaciongrupo/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Asignar nuevo grupo</button> </a> </div></div>
<a target="_blank" href="{{ route('imprimirAsignacion', ['name' => request('name')]) }}">
    <button class="btn btn-success"  value="PDF" type="submit">Generar PDF</button></a></div>
@endsection
@endrole


@role('Docente')
@section('content')

@auth
    @php
        $user = auth()->user();
    @endphp
@endauth

<h1>Grupos Asignados</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Docente</th>
<th>Asignatura</th>
<th>Numero de Grupo</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('asignaciongrupo.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Grupos Asignados"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($asignacion_grupos as $asigna)
@if($asigna->personas->id_usuario == $user->id)
<tr>
<td>{{ $asigna->id }}</td>
<td>{{ $asigna->personas->nombre }} {{ $asigna->personas->apellido }}</td>
<td>{{ $asigna->asignaturas->nombre }}</td>
<td>{{ $asigna->grupos->numero_grupo}}</td>
<td>

</a>
</td>
</tr>
@include('asignaciongrupo.modal')
@endif
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
</div>
</div>
</div>

@endsection
@endrole
@role('Director')
@section('content')


<h1>Grupos Asignados</h1>

<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Docente</th>
<th>Asignatura</th>
<th>Numero de Grupo</th>
  <th>Opciones</th>
</thead>
<tbody>
<form class="card card-header" action="{{ route('asignaciongrupo.index') }}" method="get">
    <input name="name" id='name' type="text" aria-label="Search" class="form-control" placeholder="Buscar Grupos Asignados"></input>
    <br>
    <input class="btn btn-info" type="submit" value="Buscar">
</form>
@foreach($asignacion_grupos as $asigna)
<tr>
<td>{{ $asigna->id }}</td>
<td>{{ $asigna->personas->nombre }} {{ $asigna->personas->apellido }}</td>
<td>{{ $asigna->asignaturas->nombre }}</td>
<td>{{ $asigna->grupos->numero_grupo}}</td>
<td>
<a href="{{url('asignaciongrupo/'.$asigna->id.'/edit')}}"><button class="btn btn-info">Actualizar</button></a>

<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$asigna->id}}">
  <i >Eliminar</i>
</buttom>

</a>
</td>
</tr>
@include('asignaciongrupo.modal')
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
<a href="{{url('asignaciongrupo/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Asignar nuevo grupo</button> </a> </div></div>
<a target="_blank" href="{{ route('imprimirAsignacion', ['name' => request('name')]) }}">
    <button class="btn btn-success"  value="PDF" type="submit">Generar PDF</button></a></div>
@endsection
@endrole
