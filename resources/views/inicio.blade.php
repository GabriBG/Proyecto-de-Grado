@extends('layouts.app', ['page' => 'Inicio', 'pageSlug' => 'dashboard'])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-category" style="background: linear-gradient(#0050a0, #00376e);">
                <div class="card-header ">
                            <div style="text-align: center; margin-top: 30px;-webkit-text-stroke-width: 0.2px; -webkit-text-stroke-color: rgb(255, 230, 0); font-weight: 900">
                                <img width="300" height="131" alt="" class="attachment-medium"
                                    style="max-width: 100%; border-image: 100px"
                                    src="https://www.uniajc.edu.co/wp-content/uploads/2021/04/thumbnail_Logo-UNIAJC-blanco-01-300x131.png">
                                <br>
                                <br>
                                <h1>CONTROL DE ASISTENCIA DOCENTE</h1>
                        </div>


                    </div>
                </div>
                <img width="1920" height="750" alt="" class="attachment-medium"
                                    style="max-width: 100%; border-image: 100px"
                                    src="{{ asset('black') }}/img/INICIO-UNIAJC.png">

        </div>
    </div>
    <div style="text-align: center; margin-top: 30px">
                <p>Institución Universitaria Antonio José Camacho.
                    Sede Principal Avenida 6N No 28N-102  A.A. 25663 Pbx 57 2 6652828
                    Institución de Educación Superior sujeta a inspección y vigilancia por el MEN
                    Santiago de Cali, Colombia | Todos los derechos reservados © 2021</P>
            </div>
@endsection

