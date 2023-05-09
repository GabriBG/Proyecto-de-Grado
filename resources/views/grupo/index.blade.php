@extends('layouts.app', ['pageSlug' => 'indexG'])

@section('content')

<h1>Grupo</h1>
<div class="row">
<div class="table-responsive">
<table class="table table-striped table-hover"> <thead>
<th>Id</th>
<th>Estudiantes Matriculados</th>
<th>Numero Grupo</th>
  <th>Opciones</th>
</thead>
<tbody>
@foreach($grupos as $gru)
<tr>
<td>{{ $gru->id }}</td>
<td>{{ $gru->estudiantes_matriculados }}</td>
<td>{{ $gru->numero_grupo }}</td>
<td>
<a href="{{url('grupo/'.$gru->id.'/edit')}}" ><button class="btn btn-info">Actualizar</button></a>
<button type="buttom" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$gru->id}}">
  <i >Eliminar</i>
</buttom>

</a>
</td>
</tr>
    @include('grupo.modal')
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
<a href="{{url('grupo/create')}}" class="pull-left">
<button class="btn btn-neutral btn-info">Crear Grupo</button> </a> </div></div>
@endsection
