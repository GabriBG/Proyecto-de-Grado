@extends('layouts.app', ['class' => 'login-page', 'page' => __('Inicio de sesión'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <h1 class="mb-5">CONTROL DE ASISTENCIA DOCENTE</h1>
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white" style="margin-bottom: 0px">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin-bottom: -10px;">
                        <path fill="#ffd700" fill-opacity="1" d="M0,256L34.3,229.3C68.6,203,137,149,206,128C274.3,107,343,117,411,112C480,107,549,85,617,96C685.7,107,754,149,823,165.3C891.4,181,960,171,1029,154.7C1097.1,139,1166,117,1234,128C1302.9,139,1371,181,1406,202.7L1440,224L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
                    </svg>
                    <img class="text-dark card-title" src="{{ asset('black') }}/img/LOGO-UNIAJC.png" alt="" style="width: 310px; height: auto; margin-left: 10px; margin-bottom: -20px;">
                </div>
                <div class="card-body">
                    <p class="text-dark mb-2" style="margin-top: 10px;">INICIAR SESION</p>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" href="" class="btn btn-info btn-lg btn-block mb-3">{{ __('INGRESAR') }}</button>
                    <div class="pull-left">
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
