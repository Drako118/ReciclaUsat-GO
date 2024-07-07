@extends('adminlte::page')

@section('title', 'Horarios de Mantenimiento')

@section('content')
    <div class="p-2">
        <a href="{{ route('admin.maintenances.index') }}" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Asignar Horario</button>
            <h4>Horarios del Mantenimiento {{ $maintenance->name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Día</th>
                        <th>Vehiculo</th>
                        <th>Conductor</th>
                        <th>Tipo</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Fin</th>
                        <th width="10px"></th>
                        <th width="10px"></th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->id }}</td>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ $schedule->vehicle_name }}</td>
                            <td>{{ $schedule->user_name }}</td>
                            <td>{{ $schedule->type }}</td>
                            <td>{{ $schedule->time_start }}</td>
                            <td>{{ $schedule->time_end }}</td>
                            <td>
                                <button class="btn btn-primary btnEdit" data-id="{{ $schedule->id }}"><i class="fas fa-pen"></i></button>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('admin.activities.index', $schedule->id) }}'"
                                    class="btn btn-info"><i class="fas fa-info"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('admin.schedules.destroy', [$maintenance->id, $schedule->id]) }}" method="POST" class="frmDelete">
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
    <!-- Modal para asignar horario -->
    <div class="modal fade" id="assignScheduleModal" tabindex="-1" role="dialog" aria-labelledby="assignScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignScheduleModalLabel">Asignar Horario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- El contenido del modal se cargará aquí -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#tableList').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.7/i18n/es-MX.json',
                },
            });

            $('#btnNuevo').click(function() {
                $.ajax({
                    url: "{{ route('admin.schedules.create', $maintenance->id) }}",
                    type: "GET",
                    success: function(response) {
                        $('#assignScheduleModal .modal-body').html(response);
                        $('#assignScheduleModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error("Error al cargar el formulario:", xhr.responseText);
                    }
                });
            });

            $('.btnEdit').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.schedules.edit', [$maintenance->id, '_id']) }}".replace('_id', id),
                    type: "GET",
                    success: function(response) {
                        $('#assignScheduleModal .modal-body').html(response);
                        $('#assignScheduleModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error("Error al cargar el formulario:", xhr.responseText);
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
