<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal"><img src="{{ asset('black') }}/img/uniajc.png"></a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Inicio') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#personas" aria-expanded="true">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text" >{{ __('Personas') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="personas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexP') class="active " @endif>
                            <a href="{{ route('persona.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Personas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearP') class="active " @endif>
                            <a href="{{ route('persona.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Personas') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
                <li>
                <a data-toggle="collapse" href="#asignaturas" aria-expanded="true">
                    <i class="tim-icons icon-puzzle-10" ></i>
                    <span class="nav-link-text" >{{ __('Asignaturas') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="asignaturas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexA') class="active " @endif>
                            <a href="{{ route('asignatura.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Asignaturas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearA') class="active " @endif>
                            <a href="{{ route('asignatura.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Asignaturas') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
        </ul>
    </div>
</div>
