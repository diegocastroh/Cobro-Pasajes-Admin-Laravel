@foreach ($tickets as $ticket)
    {{-- Modal Editar --}}
    <div class="modal fade" id="modaleditar-{{ $ticket->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="z-index:10000">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('boletos/' . $ticket->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Boleto</h5>
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
                        @foreach ($routes as $route)
                            @if ($ticket->ruta_id == $route->id)
                                <input type="hidden" name="ruta_id" value="{{ $route->id }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Ruta</label>
                                    <input type="text" name="ruta" class="form-control-plaintext"
                                        id="exampleFormControlInput1" value="{{ $route->nombre }}" readonly>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Precio</label>
                            <input type="numeric" name="precio" min="1" max="10" class="form-control"
                                id="exampleFormControlInput1" value="{{ $ticket->precio }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tipo</label>
                            <select class="form-control" id="exampleFormControlInput1" name="tipo" required>
                                <option value="{{ $ticket->tipo }}" selected disabled>{{ $ticket->tipo }}
                                </option>
                                <option value="Directo Especial">Directo Especial</option>
                                <option value="Directo (1)">Directo (1)</option>
                                <option value="Directo (2)">Directo (2)</option>
                                <option value="Adulto">Adulto</option>
                                <option value="Inter/Urbano">Inter/Urbano</option>
                                <option value="Urbano">Urbano</option>
                                <option value="Medio">Medio</option>
                                <option value="Escolar">Escolar</option>

                            </select>
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
@endforeach
