@extends('layouts.panel')

@section('content')
    
<form action="{{ url('/horario') }}" method="POST"> 
    @csrf
    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Gestionar Horario</h3>
            </div>
            <div class="col text-right">
              <button type="submit"  class="btn btn-sm btn-primary">
                Guardar Cambios 
            </button>
            </div>
          </div>
        </div>
        
          @if (session('notificacion'))
          <div class="alert alert-success" role="alert">
            {{ session('notificacion') }}
          </div>
          @endif
          

          @if (session('errores'))
          <div class="alert alert-danger" role="alert">
           Se encontraron las siguientes novedades:
            <ul>
                @foreach(session('errores') as $error)
                          <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
          @endif
      
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Dia</th>
                <th scope="col">Activo</th>
                <th scope="col">Turno Mañana</th>
                <th scope="col">Turno Tarde</th>
              
                
              </tr>
            </thead>    
            <tbody>
                @foreach($horarios as $key=> $horario)
                <tr>
                        <th>{{ $dias[$key] }}</th>
                        <td> 
                            <label class="custom-toggle">
                                <input type="checkbox" name="activo[]" value="{{ $key }}" 
                                @if($horario->activo)checked @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>  
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="morning_start[]">
                                        @for ($i=6; $i<=11; $i++)
                                            <option value="{{ ($i < 11 ? '0' : '').$i }}:00"
                                              @if($i.':00 AM' == $horario->morning_start) selected @endif>
                                              {{ $i }}:00 AM
                                            </option>
                                            <option value="{{ ($i < 11 ? '0' : '').$i }}:30"
                                              @if($i.':30 AM' == $horario->morning_start) selected @endif>
                                              {{ $i }}:30 AM
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">   
                                    <select class="form-control" name="morning_end[]">  
                                        @for ($i=6; $i<=11; $i++)   
                                            <option value="{{ ($i < 11 ? '0' : '').$i }}:00"
                                              @if($i.':00 AM' == $horario->morning_end) selected @endif>
                                              {{ $i }}:00 AM
                                            </option>
                                            <option value="{{ ($i < 11 ? '0' : '').$i }}:30"
                                              @if($i.':30 AM' == $horario->morning_end) selected @endif>
                                              {{ $i }}:30 AM
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="afternoon_start[]">
                                        @for ($i=1; $i<=11; $i++)
                                            <option value="{{ $i+12 }}:00"
                                              @if($i.':00 PM' == $horario->afternoon_start) selected @endif>
                                              {{ $i }}:00 PM
                                            </option>
                                            <option value="{{ $i+12 }}:30"
                                              @if($i.':30 PM' == $horario->afternoon_start) selected @endif>
                                              {{ $i }}:30 PM
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="afternoon_end[]">
                                        @for ($i=1; $i<=11; $i++)
                                            <option value="{{ $i+12 }}:00"
                                              @if($i.':00 PM' == $horario->afternoon_end) selected @endif>
                                              {{ $i }}:00 PM
                                            </option>
                                            <option value="{{ $i+12 }}:30" 
                                              @if($i.':30 PM' == $horario->afternoon_end) selected @endif>
                                              {{ $i }}:30 PM
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        
      </div>    
</form>
  
      
   
@endsection
