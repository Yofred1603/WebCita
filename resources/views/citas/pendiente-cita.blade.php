<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Medico</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Tipo</th>
               
                <th scope="col">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($pendienteCitas as $cita)
                <tr>
                    <td scope="row">
                        {{ $cita->descripcion }}
                    </td>
                    <td>
                        {{ $cita->especialidad->nombre }}
                    </td>
                    <td>
                        {{ $cita->doctor->nombre }}
                    </td>
                    <td>
                        {{ $cita->date }}
                    </td>
                    <td>
                        {{ $cita->Scheduled_Time_12}}
                    </td>
                    <td>
                        {{ $cita->tipo }}
                    </td>
                   
                    <td>

                        
                            <form action="{{ url('/miscitas/'.$cita->id.'/cancel') }}" method="POST">
                                @csrf
                           


                                <button type="submit" class="btn btn-sm btn-danger" 
                                    title="Cancelar Cita">
                                    <i class="fas fa-trash-alt"></i>
                                    Cancelar
                                </button>
                            </form>
                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>