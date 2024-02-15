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
              <h3 class="mb-0">Nuevo Usuario</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/usuarios') }}" class="btn btn-sm btn-success">
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
        <form action="{{  url('usuarios') }}" method="POST">
            @csrf
            <div class="form-group">
                    <label for="name">Nombre Usuario</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="role_id">Roles</label>
                <select name="role_id" id="role_id" class="form-control" data-style="btn-primary" 
                title="Seleccionar Rol" required>
                  @foreach($roles as $rol)
                      <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                  @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electornico</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="text" name="password" class="form-control" value="{{ old('password', Str::random(8)) }}">
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-lg btn-sm btn-primary"> Crear Usuario</button>
        </div>
       
        </form>
        
       </div>

      </div>

    </div>

  </div>
@endsection

@section('scripts')
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
