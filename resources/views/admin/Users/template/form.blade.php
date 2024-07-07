<div class="row">
    <div class="form-group col-6">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese el nombre',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('lastname', 'Apellido') !!}
        {!! Form::text('lastname', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese el apellido',
            'required',
        ]) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        {!! Form::label('dni', 'DNI') !!}
        {!! Form::text('dni', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese el DNI',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese el email',
            'required',
        ]) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        {!! Form::label('usertype_id', 'Tipo de Usuario') !!}
        {!! Form::select('usertype_id', $usertypes, null, [
            'class' => 'form-control',
            'placeholder' => 'Seleccione el tipo de usuario',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('address', 'Dirección') !!}
        {!! Form::text('address', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese la dirección',
        ]) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        {!! Form::label('birthdate', 'Fecha de Nacimiento') !!}
        {!! Form::date('birthdate', null, [
            'class' => 'form-control',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('license', 'Licencia') !!}
        {!! Form::text('license', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese la licencia',
        ]) !!}
    </div>
</div>
