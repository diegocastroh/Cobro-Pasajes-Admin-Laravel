@extends('adminlte::page')

@section('title', 'Conductores')

@section('content_header')
    <h1>Conductores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Lista de Conductores</h3>
                </div>
                <div class="col-4">
                    <div class="d-grid d-md-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <a href="{{ url('conductores.create') }}" class="btn btn-primary" data-toggle="modal"
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
            <table id="conductores-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Tipo de Seguro</th>
                        <th>Tipo de Licencia</th>
                        <th>Licencia de Conducir</th>
                        <th>Fecha Vencimiento Licencia</th>
                        <th>Hora de Ingreso</th>
                        <th>Hora de Salida</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers as $driver)
                        <tr>
                            <td>{{ $driver->id }}</td>
                            <td>{{ $driver->nombre }}</td>
                            <td>{{ $driver->dni }}</td>
                            <td>{{ $driver->tipoSeguro->nombre }}</td>
                            <td>{{ $driver->tipo_licencia }}</td>
                            <td>
                                @switch($driver->licencia_conducir)
                                    @case('Nueva')
                                        <div class="btn btn-success">
                                            Nueva
                                        </div>
                                    @break

                                    @case('Renovada')
                                        <div class="btn btn-warning">
                                            Renovada
                                        </div>
                                    @break

                                    @case('Vencida')
                                        <div class="btn btn-danger">
                                            Vencida
                                        </div>
                                    @break

                                    @default
                                        <div class="btn btn-primary">
                                            {{ $driver->licencia_conducir }}
                                        </div>
                                @endswitch
                            </td>
                            <td>{{ $driver->fecha_vencimiento_licencia }}</td>
                            <td>{{ $driver->hora_ingreso }}</td>
                            <td>{{ $driver->hora_salida }}</td>
                            <td>
                                @if ($driver->estado == 1)
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
                                {{-- <a class="btn btn-xs btn-primary" href="#modaleditar-{{ $driver->id }}"
                                    data-toggle="modal"><i class="fa fa-eye"></i></a> --}}
                                <a class="btn btn-xs btn-warning" href="#modaleditar-{{ $driver->id }}"
                                    data-toggle="modal"><i class="fa fa-edit"></i></a>
                                <form id="delete-form-{{ $driver->id }}"
                                    action="{{ url('conductores/' . $driver->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-danger"
                                        onclick="event.preventDefault(); deleteConfirmation({{ $driver->id }});"><i
                                            class="fa fa-trash"></i></button>
                                </form>


                            </td>
                        </tr>
                        {{-- Modal Editar --}}
                        <div class="modal fade" id="modaleditar-{{ $driver->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:10000">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ url('conductores/' . $driver->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Añadir Conductor</h5>
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
                                                        $('#modaleditar-'.{{ $driver->id }}).modal('show');
                                                    });
                                                </script>
                                            @endif
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nombre</label>
                                                <input type="text" name="nombre" class="form-control"
                                                    value="{{ $driver->nombre }}" id="exampleFormControlInput1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">DNI</label>
                                                <input type="text" name="dni" class="form-control"
                                                    value="{{ $driver->dni }}" id="exampleFormControlInput1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Contraseña</label>
                                                <input type="password" name="password" class="form-control" id="exampleFormControlInput1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tipo de Seguro</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    value="{{ $driver->tipo_seguro_id }}" name="tipo_seguro_id" required>
                                                    @foreach ($insurances as $insurance)
                                                        <option value="{{ $insurance->id }}">{{ $insurance->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tipo de licencia</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="tipo_licencia" required>
                                                    <option value="A-I">A-I</option>
                                                    <option value="A-IIa">A-IIa</option>
                                                    <option value="A-IIb">A-IIb</option>
                                                    <option value="A-IIIa">A-IIIa</option>
                                                    <option value="A-IIIb">A-IIIb</option>
                                                    <option value="B-I">B-I</option>
                                                    <option value="B-IIa">B-IIa</option>
                                                    <option value="B-IIb">B-IIb</option>
                                                    <option value="B-IIc">B-IIc</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2">Licencia de Conducir</label>
                                                <select class="form-control" id="exampleFormControlSelect2"
                                                    name="licencia_conducir" required>
                                                    <option value="Nueva">Nueva</option>
                                                    <option value="Renovada">Renovada</option>
                                                    <option value="Vencida">Vencida</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Fecha de Vencimiento
                                                    Licencia</label>
                                                <input type="date" class="form-control" id=""
                                                    name="fecha_vencimiento_licencia"
                                                    value="{{ $driver->fecha_vencimiento_licencia }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Hora de Ingreso</label>
                                                <input type="time" class="form-control" id=""
                                                    value="{{ $driver->hora_ingreso }}" name="hora_ingreso" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Hora de Salida</label>
                                                <input type="time" class="form-control" id=""
                                                    value="{{ $driver->hora_salida }}" name="hora_salida" required>
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

    @include('admin.conductores.create')
@stop

@section('css')

@stop

@section('js')
    <script>
        function deleteConfirmation(driverId) {
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
                    document.getElementById('delete-form-' + driverId).submit();
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
            $('#conductores-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#conductores-table_wrapper .col-md-6:eq(0)');
        });
    </script>

@stop
