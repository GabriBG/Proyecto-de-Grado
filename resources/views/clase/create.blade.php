@extends('layouts.app', ['pageSlug' => 'crearAG'])

@section('content')
<h1>Registrar Clase</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Registrar Clase</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'clase','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}
@csrf

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="docente">Grupo Asignado</label>
<select class="form-control" style="color=#FFFFFF;" name="docente">
    <option class="" value="">Seleccione el grupo</option>
    @foreach($asignacionGrupos as $asigna)
    <option value="{{ $asigna->id  }}">{{ $asigna->id }}</option>
    @endforeach
</select> </div>
</div>
<div class="form-group">
    <label for="persona">Persona:</label>
    <input type="text" name="persona" id="persona" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="asignatura">Asignatura:</label>
    <input type="text" name="asignatura" id="asignatura" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="grupo">Grupo:</label>
    <input type="text" name="grupo" id="grupo" class="form-control" readonly>
</div>
    </div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span  class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
        </div>
    </div>
</div>

{!!Form::close()!!}
@endsection
<script>
    const asignacionGrupoSelect = document.getElementById('asignacion_grupo');
    const personaInput = document.getElementById('persona');
    const asignaturaInput = document.getElementById('asignatura');
    const grupoInput = document.getElementById('grupo');

    asignacionGrupoSelect.addEventListener('change', () => {
        const asignacionGrupoId = asignacionGrupoSelect.value;

        $.ajax({
            url: `/asignacion-grupo/${asignacionGrupoId}`,
            type: 'GET',
            success: function (response) {
                personaInput.value = response.persona;
                asignaturaInput.value = response.asignatura;
                grupoInput.value = response.grupo;
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
</script>
