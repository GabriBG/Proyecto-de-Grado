use Carbon\Carbon;


@extends('layouts.app', ['page' => ('Clases'),'pageSlug' => 'dashboard'])

@section('content')
<h1>Clase</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Actualizar Clase</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
<form action="{{route('clase.update', $clases->id)}}" method="post">
{{Form::token()}}
@method('PUT')

<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
    <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
    <select class="form-control" style="color=#FFFFFF;" name="grupo_asignado" id="grupo_asignado">
        @foreach($asignacionGrupos as $grupoAsignado)
        <option value="{{ $grupoAsignado->id }}" {{ $grupoAsignado->id == $clases->grupoasignado_id ? 'selected' : '' }}>{{ $grupoAsignado->grupos->numero_grupo }}</option>
        @endforeach
    </select> </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
    <div class="form-group">
        <label for="persona" style="color:white;">Docente:</label>
        <input type="text" name="persona" id="persona" style="color:white" class="form-control" value="{{ $clases->asignacionGrupos->personas->nombre }} {{ $clases->asignacionGrupos->personas->apellido }}" readonly>
    </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="asignatura" style="color:white;">Asignatura:</label>
        <input type="text" name="asignatura" id="asignatura" style="color:white" class="form-control" value="{{ $clases->asignaturas->nombre }}" readonly>
    </div>
    </div>
    </div>
    <br>
    <div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="horario" style="color:white;" >Horario:</label>
        <select class="form-control" style="color=#FFFFFF;" name="horario" id="horario">
            @foreach($horarios as $hora)
            <option class=""  value="{{ $hora->id }}" {{ $hora->id == $clases->horario_id ? 'selected' : '' }}>{{ $hora->hora_inicio }} - {{ $hora->hora_final }}</option>
            @endforeach
        </select> </div>
        </div>
                <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="jornada" style="color:white;">Jornada:</label>
                        <input type="text" name="jornada" id="jornada" style="color:white" class="form-control" value="{{ $clases->horarios->jornada }}" readonly>
                    </div>
                    </div>

        </div>
        <br>
    <div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="aula" style="color:white;" >Aula:</label>
        <select class="form-control" style="color=#FFFFFF;" name="aula" id="aula">
            @foreach($aulas as $aul)
            <option class=""  value="{{ $aul->id }}" {{ $aul->id == $clases->aula_id ? 'selected' : '' }}>{{ $aul->nomenclatura }}</option>
            @endforeach
        </select> </div>
        </div>
            <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="sede" style="color:white;">Sede:</label>
                    <input type="text" name="sede" id="sede" style="color:white" class="form-control" value="{{ $clases->aulas->sede }}" readonly>
                </div>
                </div>

        </div>
        <br>
        <div class="row">
            <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="fecha" style="color:white;">Fecha:</label>
                <input class="form-control" type="date" value="{{ old('fecha', \Carbon\Carbon::parse($clases->fecha)->format('Y-m-d')) }}" name="fecha" id="fecha">
            </div>
        </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="asistencia" style="color:white;">Asistencia:</label>
                <select class="form-control" style="color: #FFFFFF;" name="asistencia" id="asistencia">
                    @if ($clases->asistencia == "asistida")
                    <option class=""  value="asistida">Asistida</option>
                    <option class=""  value="inasistida">Inasistida</option>
                    <option class=""  value="pendiente">Pendiente</option>
                    @elseif ($clases->asistencia == "inasistida")
                    <option class=""  value="inasistida">Inasistida</option>
                    <option class=""  value="asistida">Asistida</option>
                    <option class=""  value="pendiente">Pendiente</option>
                    @else
                    <option class=""  value="pendiente">Pendiente</option>
                    <option class=""  value="asistida">Asistida</option>
                    <option class=""  value="inasistida">Inasistida</option>
                    @endif

                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="modalidad" style="color:white;">Modalidad:</label>
            <select class="form-control" style="color: #FFFFFF;" name="modalidad" id="modalidad">
                @if ($clases->modalidad == "virtual")
                    <option class="" value="virtual">{{ ucfirst($clases->modalidad) }}</option>
                    <option class="" value="presencial">Presencial</option>
                @else
                    <option class="" value="presencial">{{ ucfirst($clases->modalidad) }}</option>
                    <option class="" value="virtual">Virtual</option>
                @endif
            </select>   </div>
    </div>
    </div>
    <br>

    <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
    <a class="btn btn-danger" href="{{ route('clase.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>
       </div>        </div>
    </div>
</div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! Html::script('./js/metodos.js') !!}
@endsection
