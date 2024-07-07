{!! Form::open(['route' => ['admin.vehicleimages.store', $vehicle->id], 'files' => true]) !!}
    @include('admin.vehicleimages.template.form')
    <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Guardar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
