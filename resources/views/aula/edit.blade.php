@extends('layouts.app', ['pageSlug' => 'crearA'])

@section('content')
<h1>Aula</h1>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Modificar Aula</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
<form action="{{route('aula.update',$aulas->id)}}" method="post">
    {{Form::token()}}
    @method('PUT')

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12"> <div class="form-group">
<label for="email">Nomenclatura</label>
<input type="text" name="nomenclatura" value="{{ isset($aulas->nomenclatura)?$aulas->nomenclatura:old('nomenclatura') }}" id="nomenclatura" class="form-control" placeholder="Nomenclatura del aula">
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="email">Sede</label>
<input type="text" name="sede" value="{{ isset($aulas->sede)?$aulas->sede:old('sede') }}" id="sede" class="form-control" placeholder="Sede">
        </div>
    </div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<a class="btn btn-danger" href="{{ route('aula.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>        </div>        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection
