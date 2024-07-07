<div class="row">
    <div class="form-group col-6">
        {!! Form::label('usertype_id', 'Tipo de Usuario') !!}
        {!! Form::select('usertype_id', $usertypes, null, [
            'class' => 'form-control',
            'placeholder' => 'Seleccione un tipo de usuario',
            'required',
            'id' => 'usertype_id'
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('user_id', 'Usuario') !!}
        {!! Form::select('user_id', [], null, [
            'class' => 'form-control',
            'placeholder' => 'Seleccione un usuario',
            'required',
            'id' => 'user_id'
        ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Estado') !!}
    {!! Form::select('status', [1 => 'Activo', 0 => 'Inactivo'], null, ['class' => 'form-control', 'required']) !!}
</div>

<script>
    $('#usertype_id').change(function() {
        var typeId = $(this).val();
        if (typeId) {
            $.ajax({
                url: "{{ url('admin/vehicleoccupants/usersByType') }}/" + typeId,
                type: "GET",
                success: function(data) {
                    $('#user_id').empty();
                    $('#user_id').append('<option value="">Seleccione un usuario</option>');
                    $.each(data, function(key, value) {
                        $('#user_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#user_id').empty();
            $('#user_id').append('<option value="">Seleccione un usuario</option>');
        }
    });
</script>
