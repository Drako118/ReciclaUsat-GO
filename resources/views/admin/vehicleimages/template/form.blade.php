<div class="form-group">
    {!! Form::label('image', 'Imagen') !!}
    {!! Form::file('image', ['class' => 'form-control', 'required', 'accept' => 'image/*',]) !!}
</div>
<div class="form-group">
    {!! Form::label('profile', 'Perfil') !!}
    {!! Form::checkbox('profile', 1, false) !!}
</div>
