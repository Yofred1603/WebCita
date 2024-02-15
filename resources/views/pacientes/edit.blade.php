@extends('layouts.panel')

@section('content')
    
  <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar Paciente</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/pacientes') }}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i> Regresar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <strong>¡Por favor ingrese!</strong> {{ $error }}
              </div>
            @endforeach
          @endif  
          <form action="{{  url('/pacientes/'.$paciente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $paciente->nombre) }}" required>
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $paciente->apellido) }}" required>
            </div>
            <div class="form-group">
              <label for="correo">Correo Electrónico</label>
              <input type="text" name="correo" class="form-control" value="{{ old('correo', $paciente->correo) }}">
            </div>
            <div class="form-group">
              <label for="dni">DNI</label>
              <input type="text" name="dni" class="form-control" value="{{ old('dni', $paciente->dni) }}">
            </div>
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}">
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-lg btn-sm btn-primary"> Guardar Paciente</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
