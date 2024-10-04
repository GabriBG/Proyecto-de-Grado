@foreach($asistencias as $asistencia)
    @if($asistencia->observacion)
        <!-- Modal para ver observación -->
        <div class="modal fade" id="modal-ver-{{$asistencia->id}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Observación de Asistencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Estudiante:</strong> {{ $asistencia->estudiante->nombres }} {{ $asistencia->estudiante->apellidos }}</p>
                        <p><strong>Observación:</strong> {{ $asistencia->observacion }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
