@extends('adminlte::page')

@section('title', 'Imágenes de Vehículo')

@section('content')
    <div class="p-2">
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Agregar Imagen</button>
            <h4>Imágenes de {{ $vehicle->name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Perfil</th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td><img src="{{ $image->image == '' ? asset('storage/vehicle_images/default.png') : $image->image }}"
                                width="120" height="80"></td>
                            <td>{{ $image->profile ? 'Sí' : 'No' }}</td>
                            <td>
                                <form action="{{ route('admin.vehicleimages.destroy', $image->id) }}" method="POST" class="frmDelete">
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
                url: "{{ route('admin.vehicleimages.create', $vehicle->id) }}",
                type: "GET",
                success: function(response) {
                    $('#imageModal .modal-body').html(response);
                    $('#imageModal').modal('show');
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
