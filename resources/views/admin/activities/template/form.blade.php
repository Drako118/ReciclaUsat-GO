<div class="form-group">
    {!! Form::label('date', 'Fecha') !!}
    {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
</div>
