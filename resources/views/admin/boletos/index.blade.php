@extends('adminlte::page')

@section('title', 'Boletos')

@section('content_header')
    <h1>Boletos</h1>

@stop

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success mt-4">
    <p>{{ $message }}</p>
</div>
@endif
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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title"><strong> {{ $route->nombre }} </strong> <small> <em>{{ $route->origen }} -
                                    {{ $route->destino }}</em></small> </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <h3 class="card-title">Boletos Registrados</h3>
                            </div>
                            <div class="col-4">
                                <div class="d-grid d-md-flex justify-content-end">
                                    <a href="{{ url('buses.create') }}" class="btn btn-primary" type="button"
                                        data-toggle="modal" data-target="#modalcrear-{{ $route->id }}">Añadir</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($tickets as $ticket)
                                @if ($ticket->ruta_id == $route->id)
                                    <div class="col-md-4 col-sm-6 col-12">
                                    @switch($ticket->tipo)
                                        @case('Directo Especial')
                                        <div class="info-box bg-gradient-dark">
                                            <span class="info-box-icon">
                                            <i class="fa-solid fa-diamond-turn-right"></i>
                                        @break

                                        @case('Directo (1)')
                                        <div class="info-box bg-gradient-secondary">
                                            <span class="info-box-icon">
                                            <i class="fa-sharp fa-solid fa-map-location-dot"></i>
                                        @break

                                        @case('Directo (2)')
                                        <div class="info-box bg-gradient-secondary">
                                            <span class="info-box-icon">
                                            <i class="fa-solid fa-route"></i>
                                        @break

                                        @case('Adulto')
                                        <div class="info-box bg-gradient-danger">
                                            <span class="info-box-icon">
                                            <i class="fa-sharp fa-solid fa-user"></i>
                                        @break

                                        @case('Inter/Urbano')
                                        <div class="info-box bg-gradient-primary">
                                            <span class="info-box-icon">
                                            <i class="fa-sharp fa-solid fa-location-dot"></i>
                                        @break

                                        @case('Urbano')
                                        <div class="info-box bg-gradient-warning">
                                            <span class="info-box-icon">
                                            <i class="fa-solid fa-tree-city"></i>
                                        @break

                                        @case('Medio')
                                        <div class="info-box bg-gradient-success">
                                            <span class="info-box-icon">
                                            <i class="fa-solid fa-user-graduate"></i>
                                        @break

                                        @case('Escolar')
                                        <div class="info-box bg-gradient-light" >
                                            <span class="info-box-icon">
                                            <i class="fa-sharp fa-solid fa-school"></i>
                                        @break
                                        @default
                                        <div class="info-box bg-info">
                                            <span class="info-box-icon">
                                            <i class="fa-solid fa-ticket"></i>
                                    @endswitch
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ $ticket->tipo }}</span>
                                                <span class="info-box-number">S/. {{ $ticket->precio }}</span>
                                                <span class="progress-description">
                                                    {{ $ticket->created_at }}
                                                    <br />
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="#modaleditar-{{ $ticket->id }}" data-toggle="modal"
                                                            class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                        <form action="{{ url('boletos/' . $ticket->id) }}" method="POST"
                                                            id="delete-form-{{ $ticket->id }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="event.preventDefault(); deleteConfirmation({{ $ticket->id }});"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @include('admin.boletos.create')
    @include('admin.boletos.edit')
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
@stop
