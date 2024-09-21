@extends('layouts.app', ['page' => ('Asignacion Grupos'),'pageSlug' => 'asignaciongrupo'])

@section('content')
<h1>Grupos Asignados</h1>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h4>Actualizar Grupos Asignados</h4>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
<form action="{{ route('asignaciongrupo.update', $asignacion_grupos->id) }}" method="post">
    {{ Form::token() }}
    @method('PUT')

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="docente">Docente</label>
                <select class="form-control" style="color=#FFFFFF;" name="docente">
                    @foreach($personas as $per)
                    <option value="{{ $per->id }}" {{ $per->id == $asignacion_grupos->personas->id ? 'selected' : '' }}>{{ $per->nombre }} {{ $per->apellido }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="asignatura">Asignatura</label>
                <select class="form-control" name="asignatura">
                    @foreach($asignaturas as $asig)
                    <option value="{{ $asig->id }}" {{ $asig->id == $asignacion_grupos->asignaturas->id ? 'selected' : '' }}>{{ $asig->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="grupo">Grupo</label>
                <select class="form-control" name="grupo">
                    @foreach($grupos as $gru)
                    <option value="{{ $gru->id }}" {{ $gru->id == $asignacion_grupos->grupos->id ? 'selected' : '' }}>{{ $gru->numero_grupo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="aula">Aula</label>
                <input type="text" class="form-control" name="aula" value="{{ $asignacion_grupos->aula }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
            <div class="form-group"><br>
                <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
                <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
            </div>
        </div>
    </div>
</form>

@endsection
