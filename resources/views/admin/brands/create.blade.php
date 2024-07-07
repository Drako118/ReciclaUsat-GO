{!! Form::open(['route' => 'admin.brands.store', 'files' => true]) !!}
@include('admin.brands.template.form')
<button type="submit" class="btn btn-success"><i class="far fa-save"></i> Registrar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>
{!! Form::close() !!}
