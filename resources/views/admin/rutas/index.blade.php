@extends('adminlte::page')

@section('title', 'Rutas')

@section('content_header')
    <h1>
        Rutas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Lista de Rutas</h3>
                </div>
                <div class="col-4">
                    <div class="d-grid d-md-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <a href="{{ url('rutas.create') }}" class="btn btn-primary" data-toggle="modal"
                            data-target="#modalcrear">
                            Añadir
                        </a>
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
            <table id="rutas-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Tiempo Estimado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes as $route)
                        <tr>
                            <td>{{ $route->id }}</td>
                            <td>{{ $route->nombre }}</td>
                            <td>{{ $route->origen }}</td>
                            <td>{{ $route->destino }}</td>
                            <td>{{ $route->tiempo_estimado }}</td>
                            <td>
                                @if ($route->estado == 1)
                                    <div class="btn btn-success">
                                        Activo
                                    </div>
                                @else
                                    <div class="btn btn-danger">
                                        Inactivo
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-warning" href="#modaleditar-{{ $route->id }}"
                                    data-toggle="modal"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('rutas.destroy', $route->id) }}" method="POST"
                                    id="delete-form-{{$route->id}}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger"
                                        onclick="event.preventDefault(); deleteConfirmation({{ $route->id }});">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        {{-- Modal Editar --}}
                        <div class="modal fade" id="modaleditar-{{$route->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" style="z-index:10000">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ url('rutas/'.$route->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Añadir Ruta</h5>
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
                                                <label for="exampleFormControlInput1">Nombre</label>
                                                <input type="text" name="nombre" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $route->nombre }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Origen</label>
                                                <input type="text" name="origen" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $route->origen }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Destino</label>
                                                <input type="text" name="destino" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $route->destino }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Tiempo Estimado</label>
                                                <input type="time" class="form-control" id=""
                                                    name="tiempo_estimado" value="{{ $route->tiempo_estimado }}" required>
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
    @include('admin.rutas.create');
@stop

@section('js')
    <script>
        function deleteConfirmation(routeId) {
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
                    document.getElementById('delete-form-' + routeId).submit();
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
            $('#rutas-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#rutas-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
