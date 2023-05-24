{{-- Modal Añadir --}}
<div class="modal fade" id="modalcrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index:10000">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('buses') }}">
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
                        <input type="text" name="placa" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Chofer</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="chofer_id" required>
                            <option selected>Seleccionar Chofer</option>
                            @foreach ($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->nombre}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Ruta</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="ruta_id" required>
                            <option selected>Seleccionar Ruta</option>
                            @foreach ($routes as $route)
                                <option value="{{$route->id}}">{{$route->nombre}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Cantidad de Pasajeros</label>
                        <input type="text" name="capacidad_pasajeros" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Modelo</label>
                        <input type="text" name="modelo" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Marca</label>
                        <input type="text" name="marca" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Fecha de Registro de Bus</label>
                        <input type="date" class="form-control" id=""
                            name="fecha_registro" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Fecha de Vencimiento
                            de Revisión Técnica</label>
                        <input type="date" class="form-control" id=""
                            name="fecha_vencimiento_revision_tecnica" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
