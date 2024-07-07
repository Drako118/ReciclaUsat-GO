<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el nombre de la marca',
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
    {!! Form::label('Seleccione una imagen', 'Logo') !!}
    {!! Form::file('logo', [
        'class' => 'form-control',
        'accept' => 'image/*',
    ]) !!}
</div>
