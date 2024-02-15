<?php
use Illuminate\Support\Str;
?>
@extends('layouts.panel')

@section('content')

    <div class="row mt-5">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Registrar Nueva Cita</h3>
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
                    <form action="{{ url('/reservacitas') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="especialidad">Especialidad</label>
                                <select name="especialidad_id" id="especialidad" class="form-control">
                                    <option value="">Seleccionar Especialidad</option>
                                    @foreach ($especialidades as $especialidad)
                                        <option value="{{ $especialidad->id }}"
                                            @if (old('especialidad_id') == $especialidad->id) selected @endif>{{ $especialidad->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="doctor">Medico</label>
                                <select name="doctor_id" id="doctor" class="form-control" required>
                                    @foreach ($doctores as $doctor)
                                        <option value="{{ $doctor->id }}"
                                            @if (old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" id="date" name="date"
                                    placeholder="Seleccionar Fecha" type="date" value="{{ old('date'), date('Y-m-d') }}"
                                    data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}"
                                    data-date-end-date="+30d">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="horas">Hora de Atencion</label>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="m-3" id="titleMorning"></h4>
                                        <div id="horasMorning">
                                            @if ($intervalos)
                                            <h4 class="m-3">En la Mañana</h4>
                                                @foreach ($intervalos['morning'] as $key => $interval)
                                                    <div class="custom-control custom-radio mb-3">
                                                        <input type="radio" id="intervalMorning{{ $key }}" name="time"
                                                            value="{{ $interval['start'] }}" class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <mark>
                                                    <small class="text-warning display-5">
                                                        Selecciona el Medico y Fecha para ver las horas.
                                                    </small>
                                                </mark>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-3" id="titleAfternoon"></h4>
                                        <div id="horasAfternoon">
                                            @if ($intervalos)
                                            <h4 class="m-3">En la Tarde</h4>
                                                @foreach ($intervalos['afternoon'] as $key => $interval)
                                                    <div class="custom-control custom-radio mb-3">
                                                        <input type="radio" id="intervalAfternoon{{ $key }}" name="time"
                                                            value="{{ $interval['start'] }}" class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tipo de Consulta</label>
                            <div class="custom-control custom-radio mt-3 mb-3">
                                <input type="radio" id="tipo1" name="tipo" class="custom-control-input"
                                    @if (old('tipo') == 'Consulta') checked @endif value="Consulta">
                                <label class="custom-control-label" for="tipo1">Consulta</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="type2" name="tipo" class="custom-control-input"
                                    @if (old('tipo') == 'Examen') checked @endif value="Examen">
                                <label class="custom-control-label" for="type2">Examen</label>
                            </div>

                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="type3" name="tipo" class="custom-control-input"
                                    @if (old('tipo') == 'Operacion') checked @endif value="Operacion">
                                <label class="custom-control-label" for="type3">Operacion</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion"> Sintomas</label>
                            <textarea name="descripcion" id="descripcion" type="text" class="form-control" rows="5"
                                placeholder="Descripcion breve de sus Sintomas" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"> Guardar Cita</button>
                    </form>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('/js/citas/create.js') }}"></script>
@endsection
