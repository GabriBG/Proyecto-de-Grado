@extends('layouts.app', ['page' => 'Inicio', 'pageSlug' => 'dashboard'])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-category" style="background: linear-gradient(#0050a0, #00376e);">
                <div class="card-header text-center">
                    <div
                        style="margin-top: 30px; -webkit-text-stroke-width: 0.2px; -webkit-text-stroke-color: rgb(255, 230, 0); font-weight: 900">
                        <h1>CONTROL DE ASISTENCIA DOCENTE</h1>
                        <img width="300" height="131" alt="" class="attachment-medium"
                            style="max-width: 100%; border-image: 100px" src="{{ asset('black') }}/img/LOGO-UNIAJC.png">
                        <br><br>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center mt-3">
                <h1>GENERACIÓN DE REPORTES</h1>
            </div>
            <!-- Primera sección -->
            <div class="d-flex flex-column align-items-center mt-3">
                <h2>Reportes de informacion registrada</h2>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('asistencia.index') }}" class="btn btn-info mx-2">Reporte de asistencias</a>
                    <a href="{{ route('clase.index') }}" class="btn btn-info mx-2">Reporte de clases</a>
                    <a href="{{ route('asignaciongrupo.index') }}" class="btn btn-info mx-2">Reporte de grupos asignados</a>

                </div>
            </div>
            <BR>
            <div class="d-flex flex-column align-items-center mt-3">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('grupo.index') }}" class="btn btn-info mx-2">Reporte de grupos</a>
                    <a href="{{ route('asignatura.index') }}" class="btn btn-info mx-2">Reporte de asignaturas</a>
                    <a href="{{ route('docente.index') }}" class="btn btn-info mx-2">Reporte de docentes</a>
                    <a href="{{ route('horario.index') }}" class="btn btn-info mx-2">Reporte de horarios</a>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div style="text-align: center; margin-top: 30px">
        <p>Institución Educativa Regional Simon Bolivar -
            Dirección: Corregimiento. San Antonio de Los Caballeros - Correo electrónico: regional@cedvalledelcauca.gov.co
            Teléfono: 262-7442

            Información general
            Área: Rural
            Carácter: Pública
            Jornadas: Mañana, Tarde | Todos los derechos reservados © 2024</p>
    </div>
@endsection
