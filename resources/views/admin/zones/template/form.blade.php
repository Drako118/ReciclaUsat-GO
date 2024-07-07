<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el nombre de la zona',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('area', 'Área') !!}
    {!! Form::text('area', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el área en metros',
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
