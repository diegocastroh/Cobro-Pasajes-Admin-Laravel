@extends('adminlte::page')

@section('title', 'Rutas')

@section('content_header')
    <h1>Rutas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Lista de Seguros</h3>
                </div>
                <div class="col-4">
                    <div class="d-grid d-md-flex justify-content-end">
                        <a href="{{ url('seguros.create') }}" class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#modalcrear">Añadir</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <table id="rutas-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Entidad de Seguros</th>
                        <th>Cobertura</th>
                        <th>Exclusiones</th>
                        <th>Costo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insurances as $insurance)
                        <tr>
                            <td>{{ $insurance->id }}</td>
                            <td>{{ $insurance->nombre }}</td>
                            <td>{{ $insurance->entidad }}</td>
                            <td>{{ $insurance->cobertura }}</td>
                            <td>{{ $insurance->exclusiones }}</td>
                            <td>{{ $insurance->costo }}</td>
                            <td>
                                <a class="btn btn-xs btn-warning" href="#modaleditar-{{ $insurance->id }}"
                                    data-toggle="modal"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('seguros.destroy', $insurance->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger"
                                    onclick="event.preventDefault(); deleteConfirmation({{ $insurance->id }});"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        {{-- Modal Editar --}}
                        <div class="modal fade" id="modaleditar-{{$insurance->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" style="z-index:10000">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ url('seguros/'.$insurance->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Seguro</h5>
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
                                                        $('#modaleditar-'.{{$insurance->id}}).modal('show');
                                                    });
                                                </script>
                                            @endif
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nombre</label>
                                                <input type="text" name="nombre" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $insurance->nombre }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Entidad</label>
                                                <input type="text" name="entidad" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $insurance->entidad }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Cobertura</label>
                                                <input type="text" name="cobertura" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $insurance->cobertura }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Exclusiones</label>
                                                <input type="text" name="exclusiones" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $insurance->exclusiones }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Costo</label>
                                                <input type="text" name="costo" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $insurance->costo }}" required>
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
    @include('admin.seguros.create')
@stop

@section('js')
<script>
    function deleteConfirmation(insuranceid) {
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
                document.getElementById('delete-form-' + insuranceid).submit();
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
