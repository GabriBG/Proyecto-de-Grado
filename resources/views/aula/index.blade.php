@extends('layouts.app', ['pageSlug' => 'indexA'])

@section('content')
<h1>Aula</h1>
<div class="row">
  
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Nomenclatura</th>
<th>Sede</th>
  <th>Opciones</th>
</thead>
<tbody>
@foreach($aulas as $au)
<tr>
<td>{{ $au->id }}</td>
<td>{{ $au->nomenclatura }}</td>
<td>{{ $au->sede }}</td>
<td>
<a href="{{url('aula/'.$au->id.'/edit')}}" ><button class="btn btn-info">Actualizar</button></a>
<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$au->id}}">
  <i >Eliminar</i>
</buttom>

</a>
</td>
</tr>
    @include('aula.modal')
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
<a href="{{url('aula/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear Persona</button> </a> </div></div>
@endsection
