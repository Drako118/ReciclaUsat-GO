{!! Form::open(['route' => ['admin.vehicleoccupants.store', $vehicle->id]]) !!}
    @include('admin.vehicleoccupants.template.form')
    <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Asignar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
