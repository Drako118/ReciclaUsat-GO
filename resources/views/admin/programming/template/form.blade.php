<div class="form-group">
    {!! Form::label('start_date', 'Fecha de Inicio') !!}
    {!! Form::date('start_date', \Carbon\Carbon::now(), [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('end_date', 'Fecha de Fin') !!}
    {!! Form::date('end_date', \Carbon\Carbon::now()->addWeek(), [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('vehicle_id', 'Vehículo') !!}
    {!! Form::select('vehicle_id', $vehicles, null, [
        'class' => 'form-control',
        'placeholder' => 'Seleccione un vehículo',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('route_id', 'Ruta') !!}
    {!! Form::select('route_id', $routes, null, [
        'class' => 'form-control',
        'placeholder' => 'Seleccione una ruta',
        'required',
    ]) !!}
</div>
