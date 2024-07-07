@extends('adminlte::page')

@section('title', 'Ocupantes del Vehículo')

@section('content')
    <div class="p-2">
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Asignar Ocupante</button>
            <h4>Ocupantes del Vehículo {{ $vehicle->name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Tipo de Usuario</th>
                        <th>Estado</th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($occupants as $occupant)
                        <tr>
                            <td>{{ $occupant->id }}</td>
                            <td>{{ $occupant->user_name }}</td>
                            <td>{{ $occupant->user_lastname }}</td>
                            <td>{{ $occupant->usertype_name }}</td>
                            <td>{{ $occupant->status ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <form action="{{ route('admin.vehicleoccupants.destroy', $occupant->id) }}" method="POST" class="frmDelete">
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
    <!-- Modal para asignar ocupante -->
    <div class="modal fade" id="assignOccupantModal" tabindex="-1" role="dialog" aria-labelledby="assignOccupantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignOccupantModalLabel">Asignar Ocupante</h5>
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
                url: "{{ route('admin.vehicleoccupants.create', $vehicle->id) }}",
                type: "GET",
                success: function(response) {
                    $('#assignOccupantModal .modal-body').html(response);
                    $('#assignOccupantModal').modal('show');
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
    @if (session('error') !== null)
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
