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
              <th scope="col">Estado</th>
              <th scope="col">Opciones</th>

          </tr>
      </thead>
      <tbody>
          @foreach ($confirmacionCitas as $cita)
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
                      {{ $cita->estado }}
                  </td>
                  <td>

                    <a href="{{ url('/miscitas/'. $cita->id.'/cancel') }}" type="submit" class="btn btn-sm btn-danger" 
                    title="Cancelar Cita"
                    
                    >
                    <i class="fas fa-trash-alt"></i>
                    Cancelar
                </a>
                          {{-- <div class="modal fade" id="confirmDeleteModal" {{ $cita->id }}" tabindex="-1"
                              role="dialog" aria-labelledby="confirmDeleteModalLabel" {{ $cita->id }}"
                              aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h1 class="modal-title" id="confirmDeleteModalLabel"
                                              {{ $cita->id }}">Confirmar Eliminación</h1>
                                          <button type="button" class="close" data-dismiss="modal"
                                              aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          ¿Estás seguro de cancelar la Cita?
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                              data-dismiss="modal">Cancelar</button>
                                          <form action="#" method="POST">
                                              <form action="{{ url('/pacientes/' . $cita->id) }}"
                                                  method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit"
                                                      class="btn btn-danger">Eliminar</button>
                                              </form>
                                      </div>
                                  </div>
                              </div>
                          </div> --}}
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>