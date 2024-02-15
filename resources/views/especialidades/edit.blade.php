@extends('layouts.panel')

@section('content')
    
  <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar Especialidades</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/especialidades') }}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i> Regresar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-circle"></i>
              <strong>Error:</strong> Por favor, revisa los campos ingresados.
            </div>
          @endif
          <form action="{{  url('/especialidades/'. $especialidad->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $especialidad->nombre) }}" required>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $especialidad->descripcion) }}">
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-lg btn-sm btn-primary"> Editar Especialidad</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection