@extends('layouts.panel')

@section('content')
    
  <div class="row mt-5">
    <div class="col-md-12 mb-4">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Medicos</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/medicos/create') }}" class="btn btn-sm btn-primary">Nueva Medico</a>
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
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">DNI</th>
                <th scope="col">Opciones</th>
                
              </tr>
            </thead>
            <tbody>
                @foreach ($doctores as $doctor)
                    
                
              <tr>
                <th scope="row">
                  {{ $doctor->nombre }}
                </th>
                <td>    
                  {{ $doctor->apellido }}
              </td>
                <td>    
                    {{ $doctor->correo }}
                </td>
                <td>    
                    {{ $doctor->dni }}
                </td>
                <td>
                 
                  <form action="{{ url('/medicos/'.$doctor->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/medicos/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Editar</a>
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{$doctor->id}}"> <i class="fas fa-trash-alt"></i>
                        Eliminar
                      </button>
                      <div class="modal fade" id="confirmDeleteModal{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$doctor->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="confirmDeleteModalLabel{{$doctor->id}}">Confirmar Eliminación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ¿Estás seguro de eliminar al doctor "{{ $doctor->nombre }} {{ $doctor->apellido }}"?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <!-- Formulario para enviar la solicitud de eliminación -->
                              <form action="{{ url('/medicos/'.$doctor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
                  
                </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-body">
          {{ $doctores->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
{{-- <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> --}}

<script src="{{ asset('/js/doctor/search.js') }}"></script>
@endsection
