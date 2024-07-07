<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el nombre del color de vehículo',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese la descripción',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('rgb_color', 'Color RGB') !!}
    {!! Form::color('rgb_color', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
