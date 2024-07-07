{!! Form::model($usertype, ['route' => ['admin.usertypes.update', $usertype], 'method' => 'put']) !!}
@include('admin.usertypes.template.form')
<button type="submit" class="btn btn-success"><i class="far fa-save"></i> Actualizar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
