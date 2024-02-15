@extends('layouts.panel')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Cancelar Cita</h3>
                        </div>

                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/miscitas') }}" class="btn btn-sm btn-success">
                          <i class="fas fa-chevron-left"></i> Regresar</a>
                      </div>

                </div>


                
                <div class="card-body">
                    @if (session('notificacion'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notificacion') }}
                    </div>
                @endif
                
                <p> Se Cancelara tu Cita Reservada con el medico <b>{{ $cita->doctor->name }}</b>
                    (especialidad) <b>{{ $cita->especialidad->name }}</b> 
                    para el dia <b>{{ $cita->date }}</b> </p>
                        
                       <form action="{{ url('/miscitas/'. $cita->id.'/cancel') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="justificacion">Poner lo motivos de la cancelacion de la Cita</label>
                            <textarea name="justificacion" id="justificacion" class="form-control" rows="3" required></textarea>
                        </div>

                        <button class="btn btn-danger" type="submit">Cancelar Cita</button>
                    </form> 

            </div>

           
           
        </div>

        </div>

    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('/js/citas/search.js') }}"></script> --}}
@endsection
