@extends('layouts.panel')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Especialidades</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('/especialidades/create') }}" class="btn btn-sm btn-primary">Nueva
                                Especialidad</a>
                        </div>
                    </div>
                </div>

                @if (session('notificacion'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notificacion') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($especialidades as $especialidad)
                                <tr>
                                    <td>{{ $especialidad->nombre }}</td>
                                    <td>{{ $especialidad->descripcion }}</td>
                                    <td>
                                        <form action="{{ url('/especialidades/' . $especialidad->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ url('/especialidades/' . $especialidad->id . '/edit') }}"
                                                class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Editar</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{$especialidad->id}}">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                        </form>
                                        <div class="modal fade" id="confirmDeleteModal{{ $especialidad->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="confirmDeleteModalLabel{{ $especialidad->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="confirmDeleteModalLabel{{ $especialidad->id }}">Confirmar
                                                            Eliminación</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar la especialidad
                                                        "{{ $especialidad->nombre }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ url('/especialidades/' . $especialidad->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
