@extends('adminlte::page')

@section('title', 'Mantenimientos')

@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Registrar</button>
            <h4>Listado de mantenimientos</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>FECHA INICIAL</th>
                        <th>FECHA FINAL</th>
                        <th width="10px"></th>
                        <th width="10px"></th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maintenances as $maintenance)
                        <tr>
                            <td>{{ $maintenance->id }}</td>
                            <td>{{ $maintenance->name }}</td>
                            <td>{{ $maintenance->date_initial }}</td>
                            <td>{{ $maintenance->date_end }}</td>
                            <td>
                                <button class="btn btn-primary btnEdit" id={{ $maintenance->id }}><i
                                        class="fas fa-pen"></i></button>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('admin.schedules.index', $maintenance->id) }}'"
                                    class="btn btn-info"><i class="fas fa-calendar"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('admin.maintenances.destroy', $maintenance->id) }}" method="POST"
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
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Mantenimientos</h5>
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
                url: "{{ route('admin.maintenances.create') }}",
                type: "GET",
                success: function(response) {
                    $('#indexModal .modal-body').html(response);
                    $('#indexModal').modal('show');
                }
            })
            //$('#indexModal').modal('show');
        });

        $('.btnEdit').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.maintenances.edit', '_id') }}".replace('_id', id),
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
                    /*Swal.fire({
                        title: "Eliminado!",
                        text: "El registro ha sido eliminado.",
                        icon: "success"
                    });*/
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
    @if (session('error') !== null)
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error"
            })
        </script>
    @endif

@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
