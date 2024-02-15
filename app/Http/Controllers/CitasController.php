<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\CancelarCita;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CitasController extends Controller
{
    //
    public function index()
    {
        // $rol = auth()->user()->rol;


        //Pacientes
        $confirmacionCitas = Cita::all()
            ->where('estado', 'Confirmada')
            ->where('paciente_id', auth()->id());

        $pendienteCitas = Cita::all()
            ->where('estado', 'Reservado')
            ->where('paciente_id', auth()->id());

        $antiguoCitas = Cita::all()
            ->whereIn('estado', ['Atendida','Cancelada'])
            ->where('paciente_id', auth()->id());

        return view('citas.index', compact('confirmacionCitas','pendienteCitas','antiguoCitas'));
    }

    // public function horariosPorDoctorYFecha($doctorId, $day)
    // {
    //     $horarios = Horario::where('doctor_id', $doctorId)
    //         ->whereDate('day', $day)
    //         ->get();

    //     // dd($horarios); 

    //     if ($horarios) {
    //         $horariosDelDia = [
    //             'morning' => [
    //                 'start' => $horarios->morning_start,
    //                 'end' => $horarios->morning_end,
    //             ],
    //             'afternoon' => [
    //                 'start' => $horarios->afternoon_start,
    //                 'end' => $horarios->afternoon_end,
    //             ],
    //         ];

    //         return response()->json($horariosDelDia);
    //     }
    //      // var_dump($horarios);
    //     return response()->json(['message' => 'No se encontraron horarios para este doctor en este día'], 404);
    // }

    // public function horariosPorFecha($day)
    // {
    //     $horarios = Horario::whereDate('day', $day)->get();

    //     return response()->json($horarios);
    // }

    public function create(HorarioServiceInterface $horarioServiceInterface)
    {
        $especialidades = Especialidad::all();
        $especialidadId = old('especialidad_id');
        if ($especialidadId) {
            $especialidad = Especialidad::find($especialidadId);
            $doctores = $especialidad->doctores;
        } else {
            $doctores = collect();
        }

        $date = old('date');
        $doctorId = old('doctor_id');

        if ($date && $doctorId) {
            $intervalos = $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
        } else {
            $intervalos = null;
        }

        return view('citas.create', compact('especialidades', 'doctores', 'intervalos'));
    }

    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface)
    {
        $data = $request->only([
            'time',
            'date',
            'tipo',
            'descripcion',
            'doctor_id',
            'especialidad_id',

        ]);

        $rules = [
            'time' =>  'required',
            'date'   =>  'required',
            'tipo'   =>  'required',
            'descripcion'   =>  'required',
            'doctor_id'  =>  'exists:users,id',
            'especialidad_id' =>  'exists:especialidades,id',
        ];

        $mensaje = [
            'time.required' =>  'Debe seleccionar una hora  para su cita.',
            'tipo.required'  =>  'Debe seleccionar el tipo de consulta.',
            'descripcion.required' =>  'Debe poner los sintomas que tiene.',
        ];

        $validator = Validator::make($request->all(), $rules, $mensaje);

        $validator->after(function ($validator) use ($request, $horarioServiceInterface) {

            $date = $request->input('date');
            $doctorId = $request->input('doctor_id');
            $time = $request->input('time');

            if ($date && $doctorId && $time) {
                $start = new Carbon($time);
            } else {
                return;
            }

            if (!$horarioServiceInterface->isAvailableInternal($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'available_time',
                    'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        // Obtener el ID del paciente autenticado 
        $data['paciente_id'] = auth()->id(); // Suponiendo que el campo se llame 'paciente_id'

        $carbomTime = Carbon::createFromFormat('g:i A', $data['time']);
        $data['time'] = $carbomTime->format('H:i:s');

        Cita::create($data);

        $notificacion = 'La cita se a realizado correctamente';

        return back()->with(compact('notificacion'));
    }

    public function cancel(Cita $cita, Request $request){

        if($request->has('justificacion')){
            $cancelacion = new CancelarCita();
            $cancelacion->justificacion = $request->input('justificacion');
            $cancelacion->cancelar_by = auth()->id();
            $cita->cancelacion()->save($cancelacion);
        }
        $cita->estado = 'Cancelada';
        $cita->save();
        $notificacion = 'La cita se ah Cancelado Correctamente';

        return redirect('/miscitas')->with(compact('notificacion'));
    }

    public function cancelarFormulario(Cita $cita){
        if($cita->estado == 'Confirmada'){
            return view('citas.cancelar', compact('cita'));
        }
       return redirect('/miscitas');
    }
}
