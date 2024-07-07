@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Registrar</button>
            <h4>Listado de Vehículos</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CÓDIGO</th>
                        <th>PLACA</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>TIPO</th>
                        <th width="10px"></th>
                        <th width="10px"></th>
                        <th width="10px"></th> <!-- Nueva columna para el botón de imágenes -->
                        <th width="10px"></th> <!-- Nueva columna para el botón de asignar conductor -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->name }}</td>
                            <td>{{ $vehicle->code }}</td>
                            <td>{{ $vehicle->plate }}</td>
                            <td>{{ $vehicle->brand_name }}</td>
                            <td>{{ $vehicle->model_name }}</td>
                            <td>{{ $vehicle->type_name }}</td>
                            <td>
                                <button onclick="window.location.href='{{ route('admin.vehicleimages.index', $vehicle->id) }}'" class="btn btn-info"><i class="fas fa-images"></i></button>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('admin.vehicleoccupants.index', $vehicle->id) }}'" class="btn btn-secondary btnAssignDriver" ><i class="fas fa-user"></i></button>
                            </td>
                            <td>
                                <button class="btn btn-primary btnEdit" id="{{ $vehicle->id }}"><i class="fas fa-pen"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="frmDelete">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
    <!-- Modal para agregar imágenes -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Agregar Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para editar vehículos -->
    <div class="modal fade" id="indexModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Vehículos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para asignar conductor -->
    <div class="modal fade" id="assignDriverModal" tabindex="-1" role="dialog" aria-labelledby="assignDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignDriverModalLabel">Asignar Conductor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#tableList').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.0.7/i18n/es-MX.json',
            },
        });

        $('#btnNuevo').click(function() {
            $.ajax({
                url: "{{ route('admin.vehicles.create') }}",
                type: "GET",
                success: function(response) {
                    $('#indexModal .modal-body').html(response);
                    $('#indexModal').modal('show');
                }
            });
        });

        $('.btnEdit').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.vehicles.edit', '_id') }}".replace('_id', id),
                type: "GET",
                success: function(response) {
                    $('#indexModal .modal-body').html(response);
                    $('#indexModal').modal('show');
                }
            });
        });

        $('.frmDelete').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Estás seguro de eliminar?",
                text: "Esta acción no se puede revertir",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    @if (session('success') !== null)
        <script>
            Swal.fire({
                title: "Proceso exitoso!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif

@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
