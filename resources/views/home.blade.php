@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center"> {{ __('BIENVENIDO A LA PAGINA CITA MEDICA') }} </h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-12 text-center" style="background-color: #f0f0f0;">
                        <br>
                        <!-- Agregar la imagen aquí -->
                        <img src="https://forotuxpan.com/wp-content/uploads/2012/07/salud-mujer-visita-al-ginecologo-privado-1280x640.jpg"
                            alt="Descripción de la imagen">
                            <br>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
