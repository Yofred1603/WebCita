<h5 class="navbar-heading text-muted">
    @if (auth()->user()->role_id == 1)
      Gestion
    @else
    Menu
    @endif
</h5>
<ul class="navbar-nav">

    @if (auth()->user()->role_id  == 1)


    <li class="nav-item  active ">
        <a class="nav-link  active " href="/home">
            <i class="ni ni-tv-2 text-danger"></i> Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="/usuarios">
            <i class="fas fa-address-book text-info"></i> Usuario
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{ url('/especialidades') }}">
            <i class="ni ni-briefcase-24 text-blue"></i> Especialidades
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="/medicos ">
            <i class="fas fa-stethoscope text-info"></i> Medicos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="/pacientes">
            <i class="fas fa-bed text-warning"></i> Pacientes
        </a>
    </li>


    @elseif( auth()->user()->role_id == 3)

    <li class="nav-item">
        <a class="nav-link " href="/horario">
            <i class="ni ni-calendar-grid-58 text-primary"></i> Gestionar Horario
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="/miscitas">
            <i class="far fa-calendar-check text-success"></i> Mis Citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="#">
            <i class="fas fa-bed text-danger"></i> Mis Pacientes
        </a>
    </li>
    {{-- dd(auth()->user()->role) --}}

    @else

    
    <li class="nav-item">
        <a class="nav-link " href="/reservacitas/create">
            <i class="ni ni-calendar-grid-58 text-primary"></i> Reservar Cita
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="/miscitas">
            <i class="far fa-calendar-check text-info"></i> Mis Citas
        </a>
    </li>

    @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="fas fa-sign-in-alt"></i> Cerrar Sesion
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
            @csrf
        </form>
    </li>
</ul>

@if (auth()->user()->role_id == 1)

<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-books text-default"></i> Citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-chart-bar-32 text-warning"></i> Desempeño Medico
        </a>
    </li>
</ul>
@endif    
