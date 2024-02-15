@extends('layouts.panel')

@section('content')
    
  <div class="row mt-5">
    <div class="col-md-12 mb-4">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Usuarios</h3>
            </div>
            <div>
              
            </div>
            <div class="col text-right">
              <a href="{{ url('/usuarios/create') }}" class="btn btn-sm btn-primary">Usuario Paciente</a>
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
                <th scope="col">Email</th>
               
                
                <th scope="col">Opciones</th>
                
              </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    
                
              <tr>
                <td scope="row">
                  {{ $usuario->name }}
                </td>
                <td>    
                  {{ $usuario->email }}
              </td>
               
                
                <td>
                 
                  <form action="{{ url('/usuarios/'.$usuario->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/usuarios/'.$usuario->id.'/edit') }}" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Editar</a> 
                      
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{$usuario->id}}"> <i class="fas fa-trash-alt"></i>
                        Eliminar
                    </button>
                  </form>
                  <div class="modal fade" id="confirmDeleteModal{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$usuario->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title" id="confirmDeleteModalLabel{{$usuario->id}}">Confirmar Eliminación</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de eliminar a {{$usuario->name}} ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <form action="{{ url('/usuarios/'.$usuario->id) }}" method="POST">
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
          {{ $usuarios->links() }}
        </div>
      </div>

    </div>

  </div>
@endsection

@section('scripts')
{{-- <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> --}}

<script src="{{ asset('/js/usuarios/search.js') }}"></script>
@endsection
