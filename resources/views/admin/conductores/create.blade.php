{{-- Modal Añadir --}}
<div class="modal fade" id="modalcrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index:10000">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('conductores') }}">
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
                                $('#modalcrear').modal('show');
                            });
                        </script>
                    @endif
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">DNI</label>
                        <input type="text" name="dni" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipo de Seguro</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="tipo_seguro_id" required>
                            <option selected>Seleccionar Seguro</option>
                            @foreach ($insurances as $insurance)
                                <option value="{{$insurance->id}}">{{$insurance->nombre}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipo de licencia</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="tipo_licencia" required>
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
                        <select class="form-control" id="exampleFormControlSelect2" name="licencia_conducir" required>
                            <option value="Nueva">Nueva</option>
                            <option value="Renovada">Renovada</option>
                            <option value="Vencida">Vencida</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Fecha de Vencimiento
                            Licencia</label>
                        <input type="date" class="form-control" id=""
                            name="fecha_vencimiento_licencia" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Hora de Ingreso</label>
                        <input type="time" class="form-control" id="" name="hora_ingreso" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Hora de Salida</label>
                        <input type="time" class="form-control" id="" name="hora_salida" required>
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
