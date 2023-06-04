@extends('layouts.app', ['class' => 'register-page', 'page' => __('PAGINA DE REGISTRO'), 'contentClass' => 'register-page'])

@section('content')
<div class="col-md-12 text-center ml-auto mr-auto">
    <h1 class="mb-5">CONTROL DE ASISTENCIA DOCENTE</h1>
</div>
<div class="col-lg-6 col-md-12 ml-auto mr-auto">
                <form class="form" method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="card card-login card-white">
                        <div class="card-header">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffd700" fill-opacity="1" d="M0,256L34.3,229.3C68.6,203,137,149,206,128C274.3,107,343,117,411,112C480,107,549,85,617,96C685.7,107,754,149,823,165.3C891.4,181,960,171,1029,154.7C1097.1,139,1166,117,1234,128C1302.9,139,1371,181,1406,202.7L1440,224L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path></svg>
                        <img class="text-dark card-title" style="margin-left: 110px; margin-right: 100px" src="{{ asset('black') }}/img/LOGO-UNIAJC.png" alt="">
                    </div>
                        <div class="card-body">
                            <p class="text-dark mb-2">REGISTRARSE</p>
                            <div class="input-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-email-85"></i>
                                    </div>
                                </div>
                            <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' es invalido' : '' }}" placeholder="{{ __('Nombre de usuario') }}">
                            @include('alerts.feedback', ['field' => 'username'])
                        </div>
                        <div class="input-group{{ $errors->has('documento_identidad') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-email-85"></i>
                                </div>
                            </div>
                        <input type="text" name="documento_identidad" class="form-control{{ $errors->has('documento_identidad') ? ' is-invalid' : '' }}" placeholder="{{ __('Documento de identidad') }}">
                        @include('alerts.feedback', ['field' => 'documento_identidad'])
                    </div>
                    <div class="input-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                    <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre Completo') }}">
                    @include('alerts.feedback', ['field' => 'nombre'])
                </div>
                <div class="input-group{{ $errors->has('apellido') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="tim-icons icon-email-85"></i>
                        </div>
                    </div>
                <input type="text" name="apellido" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" placeholder="{{ __('Apellidos') }}">
                @include('alerts.feedback', ['field' => 'apellido'])
            </div>
                            <div class="input-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-email-85"></i>
                                    </div>
                                </div>
                            <input type="text" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefono') }}">
                            @include('alerts.feedback', ['field' => 'telefono'])
                        </div>
                        <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                        </div>
                        <div class="form-check text-left">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span class="form-check-sign"></span>
                                {{ __('I agree to the') }}
                                <a href="#">{{ __('terms and conditions') }}</a>.
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Get Started') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
