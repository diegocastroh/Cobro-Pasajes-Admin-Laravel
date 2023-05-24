{{-- Modal Añadir --}}
<div class="modal fade" id="modalcrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index:10000">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('rutas') }}">
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
                        <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Origen</label>
                        <input type="text" name="origen" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Destino</label>
                        <input type="text" name="destino" class="form-control" id="exampleFormControlInput1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Tiempo Estimado</label>
                        <input type="time" class="form-control" id="" name="tiempo_estimado" required>
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
