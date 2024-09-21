@extends('layouts.app', ['page' => __('Perfil de Usuario'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Editar Perfil') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
    <label>{{ __('Nombre') }}</label>
    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{ isset(auth()->user()->persona->nombre) ? auth()->user()->persona->nombre : old('name', optional(auth()->user()->persona)->nombre) }}">
    @include('alerts.feedback', ['field' => 'name'])
</div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Correo electronico') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo Electronico') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-info">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Contraseña') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Contraseña actual') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña Actual') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('Nueva contraseña') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Nueva Contraseña') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirmar nueva contraseña') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirmar Nueva Contraseña') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-info">{{ __('Cambiar contraseña') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ __('Institucion Educativa Regional Simon Bolivar') }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        <p>{{ __('La Institución Educativa Regional Simón Bolívar, se encuentra ubicada en el corregimiento San Antonio de los Caballeros, del municipio de Florida Valle, al frente del Centro Nacional de Investigación de la Caña de Azúcar CENICAÑA.') }}</p>
                        <p>{{ __('En el año 1.965 el señor Jaime Domínguez Vásquez, donó el terreno para que se construyera el plantel. La construcción se realizó con dineros provenientes del Estado y de donaciones de habitantes de la comunidad. Inició labores, en el año 1969, como satélite del colegio Germán Nieto, de Candelaria. Su primer rector entre los años 1969 y 1971 fue el señor Raúl Abella. La primera promoción de bachilleres graduandos a nombre de este plantel, fue en el año 1973, siendo rector el Lic. Nelson Díaz Nieto y Coordinador, el Lic. Óscar Ocampo.') }}</p>
                        <p>{{ __('Debido a que la principal fuente económica de esta región, es la agroindustria azucarera, y en menor escala, los cultivos de pancoger; se decidió que el plantel tuviera la modalidad agropecuaria. Desde su inicio, y hasta el año 1972, este plantel sólo ofrecía educación básica secundaria; es decir, los grados 1°, 2°, 3° y 4° de bachillerato, equivalentes a los grados de 6° a 9° de la actualidad. El nivel de educación media, o sea los grados 5° y 6° se ofrecieron en convenio con los colegios Germán Nieto del municipio de Candelaria Y Cárdenas de Palmira.') }}</p>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <a href="https://www.facebook.com/TECNOLOGOSDEFLORIDA/?locale=es_LA " target="_blank">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button></a>
                        <a href="https://ieregionalsimonbolivar.weebly.com/" target="_blank">
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
