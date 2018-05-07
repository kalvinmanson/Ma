<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="/img/logo-ima.png" class="w-50" alt="Instituto Moderno Americano"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @if(Auth::check())
          @if(Auth::user()->grade)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->grade->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach(Auth::user()->enrollments as $menuEnrollment)
                  <a class="dropdown-item" href="/g/{{ $menuEnrollment->course->grade->slug }}/c/{{ $menuEnrollment->course->slug }}">{{ $menuEnrollment->course->name }}</a>
                @endforeach
              </div>
            </li>
          @endif
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/explore">Explorar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login/google">Iniciar sesión</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
