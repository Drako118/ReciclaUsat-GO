<div class="form-group">
    {!! Form::label('day', 'Día') !!}
    {!! Form::select('day', [
        'Lunes' => 'Lunes',
        'Martes' => 'Martes',
        'Miércoles' => 'Miércoles',
        'Jueves' => 'Jueves',
        'Viernes' => 'Viernes',
        'Sábado' => 'Sábado',
        'Domingo' => 'Domingo'
    ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un día', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('type', 'Tipo') !!}
    {!! Form::select('type', [
        'Limpieza' => 'Limpieza',
        'Reparación' => 'Reparación'
    ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un tipo', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('time_start', 'Hora de Inicio') !!}
    {!! Form::time('time_start', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('time_end', 'Hora de Fin') !!}
    {!! Form::time('time_end', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('vehicle_id', 'Vehículo') !!}
    {!! Form::select('vehicle_id', $vehicles->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un vehículo', 'required']) !!}
</div>
