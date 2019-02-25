<div class="bg-dark text-white">
  <div class="container-fluid pt-2 pt-lg-4">
    <div class="row">
      <div class="col-sm-2 col-lg-1 text-center">
        <div class="d-none d-sm-inline-block">
          <img src="{{ $course->picture  or '/img/no-course-pic.png' }}" class="img-fluid pb-3" alt="{{ $course->name }} grado {{ $course->grade->name }}">
        </div>
      </div>
      <div class="col-sm-9 col-lg-10">
        <h3>{{ $course->name }}</h3>
        <p>{{ $course->description }}</p>
      </div>
    </div>
    <nav class="nav bg-light justify-content-center">
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}"><i class="fas fa-tachometer-alt"></i></a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/contents">Contenidos</a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/activities">Actividades</a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/forum">Foro</a>
      {{--<a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/members">Miembros</a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/questions">Desafío</a>--}}
    </nav>
  </div>
</div>
