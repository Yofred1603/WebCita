<?php
use Illuminate\Support\Str;
?>
@extends('layouts.panel')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    
  <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar Medico</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/medicos') }}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i>Regresar</a>
            </div>
          </div>
        </div>
       <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-circle"></i>
              <strong>Porfavor ingresar!</strong> {{ $error }}
          </div>
            @endforeach
        @endif
        <form action="{{  url('/medicos/'.$doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                    <label for="nombre">Nombre Medico</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $doctor->nombre) }}" required>
            </div>
            <div class="form-group">
              <label for="especialidades">Especialidades</label>
              <select name="especialidades[]" id="especialidades" class="form-control selectpicker" data-style="btn-primary" 
              title="Seleccionar Especialidades" multiple required>
                @foreach($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $doctor->apellido) }}">
        </div>

            <div class="form-group">
                <label for="correo">Correo Electornico</label>
                <input type="text" name="correo" class="form-control" value="{{ old('correo', $doctor->correo) }}">
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{ old('dni', $doctor->dni) }}">
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $doctor->direccion) }}">
            </div>
            <div class="form-group">
              <label for="colegiatura">Colegiatura</label>
              <input type="text" name="colegiatura" class="form-control" value="{{ old('colegiatura', $doctor->colegiatura) }}">
          </div>
            <div class="form-group">
                <label for="telefono">Teléfono / Celular</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $doctor->telefono) }}">
            </div>
            {{-- <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="text" name="password" class="form-control">
              <small class="text-warning">Solo llene el campo si desea cambiar la Contraseña</small>
          </div> --}}
          <div class="text-right">
            <button type="submit" class="btn btn-lg btn-sm btn-primary"> Guardar Medico</button>
        </div>
        </form>
       </div>

      </div>

    </div>

  </div>
@endsection

@section('scripts')
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

      <script>
         $(document).ready(() => {
            $('#especialidades').selectpicker('val', @json($especialidades_ids));
        });
      </script>
@endsection