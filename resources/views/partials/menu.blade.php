<header>
  <a class="navbar-brand" href="/"><img src="/img/logo-ima.png" class="w-50" alt="Instituto Moderno Americano"></a>
</header>
<ul class="list-group">
  @if(Auth::check())
    <div class="card">
      <div class="card-body py-0">
        <img src="{{ Auth::user()->avatar }}" class="float-left mr-2">
        <p>
          <strong>{{ Auth::user()->name }}</strong><br>
          <small>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off"></i> Cerrar Sesión</a>
          </small>
        </p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </div>
  @endif
  <ul class="navbar-nav">
    @if(Auth::check())
      @if(Auth::user()->grade)
          @foreach(Auth::user()->enrollments as $menuEnrollment)
            <a class="list-group-item" href="/g/{{ $menuEnrollment->course->grade->slug }}/c/{{ $menuEnrollment->course->slug }}">
              {{ $menuEnrollment->course->name }}
              <small class="text-secondary">{{ $menuEnrollment->course->grade->name }}</small>
            </a>
          @endforeach
      @endif

    @else
    <a class="list-group-item" href="/login/google">Iniciar sesión</a>
    @endif
    <a class="list-group-item" href="/explore">Explorar Cursos</a>
</ul>
