{!! Form::model($vehicleroute, ['route' => ['admin.vehicleroutes.update', $vehicleroute->id], 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::label('description', 'Descripción') !!}
        {!! Form::textarea('description', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese la descripción de la ruta',
            'required',
        ]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('routestatus_id', 'Estado de Ruta') !!}
        {!! Form::select('routestatus_id', $routestatuses, null, [
            'class' => 'form-control',
            'placeholder' => 'Seleccione un estado de ruta',
            'required',
        ]) !!}
    </div>
    <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Actualizar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
