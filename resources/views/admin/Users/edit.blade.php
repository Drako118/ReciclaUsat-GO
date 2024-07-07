{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'put']) !!}
    @include('admin.users.template.form')
    <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Actualizar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
