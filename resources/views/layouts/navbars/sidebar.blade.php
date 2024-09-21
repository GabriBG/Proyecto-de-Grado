@role('Admin')
<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/home" class="simple-text logo-normal"><img src="{{ asset('black') }}/img/LOGO-UNIAJC.png"></a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Inicio') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'asignaciongrupo') class="active " @endif>
                <a data-toggle="collapse" href="#asignaciongrupo" aria-expanded="false">
                    <i class="tim-icons icon-pin" ></i>
                    <span class="nav-link-text" >{{ __('Grupos Asignados') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="asignaciongrupo">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexAG') class="active " @endif>
                            <a href="{{ route('asignaciongrupo.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Grupos Asignados') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearAG') class="active " @endif>
                            <a href="{{ route('asignaciongrupo.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Grupos') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'clase') class="active " @endif>
                <a data-toggle="collapse" href="#clase" aria-expanded="false">
                    <i class="tim-icons icon-globe-2" ></i>
                    <span class="nav-link-text" >{{ __('Clases') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="clase">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexC') class="active " @endif>
                            <a href="{{ route('clase.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Clases') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearC') class="active " @endif>
                            <a href="{{ route('clase.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Clases') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'personas') class="active " @endif>
                <a data-toggle="collapse" href="#personas" aria-expanded="false">
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
            <li @if ($pageSlug == 'docentes') class="active " @endif>
                <a data-toggle="collapse" href="#docentes" aria-expanded="false">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text" >{{ __('Docentes') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="docentes">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexD') class="active " @endif>
                            <a href="{{ route('docente.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Docentes') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearD') class="active " @endif>
                            <a href="{{ route('docente.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Docentes') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
                <li @if ($pageSlug == 'asignaturas') class="active " @endif>
                <a data-toggle="collapse" href="#asignaturas" aria-expanded="false">
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
                </li>
                <li @if ($pageSlug == 'grupos') class="active " @endif>
                <a data-toggle="collapse" href="#grupos" aria-expanded="false">
                    <i class="tim-icons icon-world" ></i>
                    <span class="nav-link-text" >{{ __('Grupos') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="grupos">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexG') class="active " @endif>
                            <a href="{{ route('grupo.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Grupos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearG') class="active " @endif>
                            <a href="{{ route('grupo.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Grupos') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'horarios') class="active " @endif>
                <a data-toggle="collapse" href="#horarios" aria-expanded="false">
                    <i class="tim-icons icon-calendar-60" ></i>
                    <span class="nav-link-text" >{{ __('Horarios') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="horarios">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexH') class="active " @endif>
                            <a href="{{ route('horario.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Horarios') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearH') class="active " @endif>
                            <a href="{{ route('horario.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Horarios') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--}}
            <li>
                <a data-toggle="collapse" href="#aulas" aria-expanded="false">
                    <i class="tim-icons icon-square-pin" ></i>
                    <span class="nav-link-text" >{{ __('Aulas') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="aulas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexAu') class="active " @endif>
                            <a href="{{ route('aula.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Aulas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearAu') class="active " @endif>
                            <a href="{{ route('aula.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Aulas') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            --}}
        </ul>
    </div>
</div>
@endrole
@role('Director')
<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/home" class="simple-text logo-normal"><img src="{{ asset('black') }}/img/uniajc.png"></a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Inicio') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'asignaciongrupo') class="active " @endif>
                <a data-toggle="collapse" href="#asignaciongrupo" aria-expanded="false">
                    <i class="tim-icons icon-pin" ></i>
                    <span class="nav-link-text" >{{ __('Grupos Asignados') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="asignaciongrupo">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexAG') class="active " @endif>
                            <a href="{{ route('asignaciongrupo.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Grupos Asignados') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearAG') class="active " @endif>
                            <a href="{{ route('asignaciongrupo.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Grupos') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'clase') class="active " @endif>
                <a data-toggle="collapse" href="#clase" aria-expanded="false">
                    <i class="tim-icons icon-globe-2" ></i>
                    <span class="nav-link-text" >{{ __('Clases') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="clase">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexC') class="active " @endif>
                            <a href="{{ route('clase.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Clases') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearC') class="active " @endif>
                            <a href="{{ route('clase.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Clases') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'docentes') class="active " @endif>
                <a data-toggle="collapse" href="#docentes" aria-expanded="false">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text" >{{ __('Docentes') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="docentes">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexD') class="active " @endif>
                            <a href="{{ route('docente.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Docentes') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearD') class="active " @endif>
                            <a href="{{ route('docente.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Docentes') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
                <li @if ($pageSlug == 'asignaturas') class="active " @endif>
                <a data-toggle="collapse" href="#asignaturas" aria-expanded="false">
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
                </li>
                <li @if ($pageSlug == 'grupos') class="active " @endif>
                <a data-toggle="collapse" href="#grupos" aria-expanded="false">
                    <i class="tim-icons icon-world" ></i>
                    <span class="nav-link-text" >{{ __('Grupos') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="grupos">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexG') class="active " @endif>
                            <a href="{{ route('grupo.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Grupos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearG') class="active " @endif>
                            <a href="{{ route('grupo.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Grupos') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'horarios') class="active " @endif>
                <a data-toggle="collapse" href="#horarios" aria-expanded="false">
                    <i class="tim-icons icon-calendar-60" ></i>
                    <span class="nav-link-text" >{{ __('Horarios') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="horarios">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexH') class="active " @endif>
                            <a href="{{ route('horario.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Horarios') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearH') class="active " @endif>
                            <a href="{{ route('horario.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Horarios') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--
            <li>
                <a data-toggle="collapse" href="#aulas" aria-expanded="false">
                    <i class="tim-icons icon-square-pin" ></i>
                    <span class="nav-link-text" >{{ __('Aulas') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="aulas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexAu') class="active " @endif>
                            <a href="{{ route('aula.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Aulas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearAu') class="active " @endif>
                            <a href="{{ route('aula.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Aulas') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            --}}
        </ul>
    </div>
</div>
@endrole
@role('Docente')
<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/home" class="simple-text logo-normal"><img src="{{ asset('black') }}/img/uniajc.png"></a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Inicio') }}</p>
                </a>
            </li>
                <li @if ($pageSlug == 'asignaturas') class="active " @endif>
                <a data-toggle="collapse" href="#asignaturas" aria-expanded="false">
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
                </li>
                <li @if ($pageSlug == 'grupos') class="active " @endif>
                <a data-toggle="collapse" href="#grupos" aria-expanded="false">
                    <i class="tim-icons icon-world" ></i>
                    <span class="nav-link-text" >{{ __('Grupos') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="grupos">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexG') class="active " @endif>
                            <a href="{{ route('grupo.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Grupos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearG') class="active " @endif>
                            <a href="{{ route('grupo.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Grupos') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'horarios') class="active " @endif>
                <a data-toggle="collapse" href="#horarios" aria-expanded="false">
                    <i class="tim-icons icon-calendar-60" ></i>
                    <span class="nav-link-text" >{{ __('Horarios') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="horarios">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexH') class="active " @endif>
                            <a href="{{ route('horario.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Horarios') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearH') class="active " @endif>
                            <a href="{{ route('horario.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Horarios') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
{{--
                <li>
                <a data-toggle="collapse" href="#aulas" aria-expanded="false">
                    <i class="tim-icons icon-square-pin" ></i>
                    <span class="nav-link-text" >{{ __('Aulas') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="aulas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexAu') class="active " @endif>
                            <a href="{{ route('aula.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Aulas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearAu') class="active " @endif>
                            <a href="{{ route('aula.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Insertar Aulas') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            --}}
            <li @if ($pageSlug == 'asignaciongrupo') class="active " @endif>
                <a data-toggle="collapse" href="#asignaciongrupo" aria-expanded="false">
                    <i class="tim-icons icon-pin" ></i>
                    <span class="nav-link-text" >{{ __('Grupos Asignados') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="asignaciongrupo">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexAG') class="active " @endif>
                            <a href="{{ route('asignaciongrupo.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Grupos Asignados') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'clase') class="active " @endif>
                <a data-toggle="collapse" href="#clase" aria-expanded="false">
                    <i class="tim-icons icon-globe-2" ></i>
                    <span class="nav-link-text" >{{ __('Clases') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="clase">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'indexC') class="active " @endif>
                            <a href="{{ route('clase.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{ __('Consultar Clases') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'crearC') class="active " @endif>
                            <a href="{{ route('clase.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Asignar Clases') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endrole
