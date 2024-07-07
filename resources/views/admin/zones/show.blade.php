@extends('adminlte::page')

@section('title', 'Perímetro de la zona')

@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" id="btnNuevo">
                <i class="fas fa-plus-circle"></i> Agregar coordenada</button>
            Perímetro de la zona {{ $zone->name }}

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <label for="">Zona:</label> {{ $zone->name }} <br>
                    <label for="">Área: </label> {{ $zone->area }} <br>
                    <label for="">Descripción</label>
                    {{ $zone->description }}
                </div>
                <div class="col-8">
                    <div class="card">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>LATITUD</th>
                                    <th>LONGITUD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($zoneCoords as $zoneCoord)
                                    <tr>
                                        <td>{{ $zoneCoord->latitude }}</td>
                                        <td>{{ $zoneCoord->longitude }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="indexModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar coordenada</h5>
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
        $('#btnNuevo').click(function() {
            var id = {{ $zone->id }}

            $.ajax({

                url: "{{ route('admin.zonecoords.edit', '_id') }}".replace('_id', id),
                type: "GET",
                success: function(response) {
                    $('#indexModal .modal-body').html(response);
                    $('#indexModal').modal('show');
                }
            })
            //$('#indexModal').modal('show');
        });
    </script>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
