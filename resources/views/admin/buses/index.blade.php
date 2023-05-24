@extends('adminlte::page')

@section('title', 'Buses')

@section('content_header')
    <h1>Buses</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Lista de Buses</h3>
                </div>
                <div class="col-4">
                    <div class="d-grid d-md-flex justify-content-end">
                        <a href="{{ url('buses.create') }}" class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#modalcrear">Añadir</a>
                    </div>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-4">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table id="buses-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Placa</th>
                        <th>Chofer</th>
                        <th>Ruta</th>
                        <th>Capacidad de Pasajeros</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Fecha de Registro de Bus</th>
                        <th>Fecha de Vencimiento de Revisión Técnica</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buses as $bus)
                        <tr>
                            <td>{{ $bus->id }}</td>
                            <td>{{ $bus->placa }}</td>
                            <td>{{ $bus->Driver->nombre }}</td>
                            <td>{{ $bus->Route->nombre }}</td>
                            <td>{{ $bus->capacidad_pasajeros }}</td>
                            <td>{{ $bus->modelo }}</td>
                            <td>{{ $bus->marca }}</td>
                            <td>{{ $bus->fecha_registro }}</td>
                            <td>{{ $bus->fecha_vencimiento_revision_tecnica }}</td>
                            <td>
                                @if ($bus->estado == 1)
                                <div class="btn btn-success">
                                    Activo
                                </div>
                            @else
                                <div class="btn btn-danger">
                                    Inactivo
                                </div>
                            @endif</td>
                            <td>
                                <a class="btn btn-xs btn-warning" href="#modaleditar-{{ $bus->id }}"
                                    data-toggle="modal" ><i class="fa fa-edit"></i></a>
                                <form action="{{ url('buses/'. $bus->id) }}" method="POST"
                                    id="delete-form-{{$bus->id}}" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-danger" onclick="event.preventDefault(); deleteConfirmation({{ $bus->id }});"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Editar --}}
                        <div class="modal fade" id="modaleditar-{{$bus->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" style="z-index:10000">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ url('buses/'. $bus->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Añadir Buses</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <script>
                                                    $(document).ready(function() {
                                                        $('#modalcrear').modal('show');
                                                    });
                                                </script>
                                            @endif
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Placa</label>
                                                <input type="text" name="nombre" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $bus->id }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Chofer</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="tipo_seguro_id" value="{{ $bus->chofer_id }}" required>
                                                    <option selected>Seleccionar Chofer</option>
                                                    @foreach ($drivers as $driver)
                                                        <option value="{{ $driver->id }}">{{ $driver->nombre }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Ruta</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="tipo_seguro_id" value="{{ $bus->ruta_id }}" required>
                                                    <option selected>Seleccionar Ruta</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}">{{ $route->nombre }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Cantidad de Pasajeros</label>
                                                <input type="text" name="cobertura" class="form-control" value="{{ $bus->capacidad_pasajeros }}"
                                                    id="exampleFormControlInput1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Modelo</label>
                                                <input type="text" name="exclusiones" class="form-control" value="{{ $bus->modelo }}"
                                                    id="exampleFormControlInput1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Marca</label>
                                                <input type="text" name="costo" class="form-control" value="{{ $bus->marca }}"
                                                    id="exampleFormControlInput1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Fecha de Registro de Bus</label>
                                                <input type="date" class="form-control" id="" value="{{ $bus->fecha_registro_bus }}"
                                                    name="fecha_vencimiento_licencia" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Fecha de Vencimiento
                                                    de Revisión Técnica</label>
                                                <input type="date" class="form-control" id="" value="{{ $bus->fecha_vencimiento_revision_tecnica }}"
                                                    name="fecha_vencimiento_licencia" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.buses.create')
@stop

@section('css')
@stop

@section('js')
<script>
    function deleteConfirmation(busid) {
        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar este registro?",
            text: "No podrás recuperar este registro después de eliminarlo.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#Ff0000",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.value) {
                document.getElementById('delete-form-' + busid).submit();
            } else {
                Swal.fire({
                    title: "Cancelado",
                    text: "El registro no ha sido eliminado.",
                    type: "error",
                    timer: 2000
                });
            }
        });
    }
</script>
    <script>
        $(function() {
            $('#buses-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#buses-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
