<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el nombre del mantenimiento',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('date_initial', 'Fecha Inicial') !!}
    {!! Form::date('date_initial', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('date_end', 'Fecha Final') !!}
    {!! Form::date('date_end', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
