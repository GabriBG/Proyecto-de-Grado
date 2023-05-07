
<div class="modal fade" id="modal-delete-{{$asi->id}}" tabindex="-1" aria- labelledby="ModalLabel" aria-hidden="true">
{{Form::Open(array('action'=>array('App\Http\Controllers\AsignaturaController@destroy',$asi->id),'method'=>'delete'))}}
<div class="modal-dialog"> <div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Eliminar asignatura</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-
label="Close"></button> </div>
<div class="modal-body">
<p>Confirme si desea eliminar la asignatura</p> </div>
<div class="modal-footer">
<button type="button" class="btn btn-info" data-bs- dismiss="modal">Cerrar</button>
<button type="submit" class="btn btn-danger">Confirmar</button> </div>
    </div>
  </div>
</div> {{Form::Close()}}
