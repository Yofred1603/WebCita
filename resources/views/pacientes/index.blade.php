@extends('layouts.panel')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Pacientes</h3>
                        </div>
                        <div>

                        </div>
                        <div class="col text-right">
                            <a href="{{ url('/pacientes/create') }}" class="btn btn-sm btn-primary">Nuevo Paciente</a>
                        </div>

                        <div class="col text-right">
                            <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente...">
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
                    <table class="table align-items-center table-flush custom-table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Opciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td scope="row">
                                        {{ $paciente->nombre }}
                                    </td>
                                    <td>
                                        {{ $paciente->apellido }}
                                    </td>
                                    <td>
                                        {{ $paciente->correo }}
                                    </td>
                                    <td>
                                        {{ $paciente->dni }}
                                    </td>
                                    <td>
                                        {{ $paciente->direccion }}
                                    </td>
                                    <td>
                                        {{ $paciente->telefono }}
                                    </td>
                                    <td>

                                        <form action="{{ url('/pacientes/' . $paciente->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('/pacientes/' . $paciente->id . '/edit') }}"
                                                class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Editar</a>

                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#confirmDeleteModal{{ $paciente->id }}"> <i
                                                    class="fas fa-trash-alt"></i>
                                                Eliminar
                                            </button>
                                        </form>
                                        <div class="modal fade" id="confirmDeleteModal{{ $paciente->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $paciente->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title"
                                                            id="confirmDeleteModalLabel{{ $paciente->id }}">Confirmar
                                                            Eliminación</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar a {{ $paciente->nombre }}
                                                        {{ $paciente->apellido }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ url('/pacientes/' . $paciente->id) }}"
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
                <div class="card-body">
                    {{ $pacientes->links() }}
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> --}}

    <script src="{{ asset('/js/paciente/search.js') }}"></script>
@endsection
