{!! Form::model($activity, ['route' => ['admin.activities.update', $schedule->id, $activity->id], 'method' => 'put']) !!}
@include('admin.activities.template.form')
<button type="submit" class="btn btn-success"><i class="far fa-save"></i> Actualizar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
