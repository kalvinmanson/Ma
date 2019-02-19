<header>
  <a class="navbar-brand" href="/"><img src="/img/logo-ima.png" class="w-50" alt="Instituto Moderno Americano"></a>
</header>
<ul class="list-group">
  <ul class="navbar-nav ml-auto">
    @if(Auth::check())
      @if(Auth::user()->grade)
          @foreach(Auth::user()->enrollments as $menuEnrollment)
            <a class="list-group-item" href="/g/{{ $menuEnrollment->course->grade->slug }}/c/{{ $menuEnrollment->course->slug }}">
              {{ $menuEnrollment->course->name }}
              <small class="text-secondary">{{ $menuEnrollment->course->grade->name }}</small>
            </a>
          @endforeach
      @endif
    <li class="list-group-item">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Salir</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </li>
    @else
    <a class="list-group-item" href="/explore">Explorar</a>
    <a class="list-group-item" href="/login/google">Iniciar sesión</a>
    @endif
</ul>
