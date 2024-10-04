@extends('layouts.app', ['page' => ('Horarios'),'pageSlug' => 'horarios'])

@section('content')
<h1>Horario </h1>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h4>Actualizar Horario</h4>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
<form action="{{route('horario.update',$horarios->id)}}" method="post">
    {{Form::token()}}
    @method('PUT')

    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="jornada">Jornada</label>
                <select name="jornada" id="jornada" class="form-control">
                    <option value="Mañana" {{ $horarios->jornada == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                    <option value="Tarde" {{ $horarios->jornada == 'Sabatina' ? 'selected' : '' }}>Sabatina</option>
                </select>
            </div>
        </div>

        <!-- Campo para seleccionar hora de inicio -->
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="hora_inicio">Hora de inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" value="{{ isset($horarios->hora_inicio) ? $horarios->hora_inicio : old('hora_inicio') }}" class="form-control">
            </div>
        </div>

        <!-- Campo para seleccionar hora de final -->
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="hora_final">Hora de final</label>
                <input type="time" name="hora_final" id="hora_final" value="{{ isset($horarios->hora_final) ? $horarios->hora_final : old('hora_final') }}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
            <div class="form-group">
                <br>
                <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
                <a class="btn btn-danger" href="{{ route('horario.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>
            </div>
        </div>
    </div>
</form>
@endsection
