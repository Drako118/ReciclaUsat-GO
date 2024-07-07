@extends('adminlte::page')

@section('title', 'Colores de Vehículos')

@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Registrar</button>
            <h4>Listado de colores de vehículos</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>RGB</th>
                        <th>DESCRIPCIÓN</th>
                        <th width="10px"></th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiclecolors as $vehiclecolor)
                        <tr>
                            <td>{{ $vehiclecolor->id }}</td>
                            <td>{{ $vehiclecolor->name }}</td>
                            <td>
                                <input type="color" value="{{ $vehiclecolor->rgb_color }}" disabled>
                            </td>
                            <td>{{ $vehiclecolor->description }}</td>
                            <td>
                                <button class="btn btn-primary btnEdit" id={{ $vehiclecolor->id }}><i
                                        class="fas fa-pen"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('admin.vehiclecolors.destroy', $vehiclecolor->id) }}" method="POST"
                                    class="frmDelete">
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
    <!-- Modal -->
    <div class="modal fade" id="indexModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Colores de Vehículos</h5>
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
                url: "{{ route('admin.vehiclecolors.create') }}",
                type: "GET",
                success: function(response) {
                    $('#indexModal .modal-body').html(response);
                    $('#indexModal').modal('show');
                }
            })
        });

        $('.btnEdit').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.vehiclecolors.edit', '_id') }}".replace('_id', id),
                type: "GET",
                success: function(response) {
                    $('#indexModal .modal-body').html(response);
                    $('#indexModal').modal('show');
                }
            })
        })

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
        })
    </script>

    @if (session('success') !== null)
        <script>
            Swal.fire({
                title: "Proceso exitoso!",
                text: "{{ session('success') }}",
                icon: "success"
            })
        </script>
    @endif

@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
