<div class="bg-dark text-white">
  <div class="container pt-2 pt-lg-4">
    <div class="row">
      <div class="col-sm-3 col-lg-2 text-center">
        <div class="d-none d-sm-inline-block">
          <img src="{{ $course->picture}}" class="img-fluid pb-3">
        </div>
      </div>
      <div class="col-sm-9 col-lg-10">
        <h3>{{ $course->name }}</h3>
        <p>{{ $course->description }}</p>
      </div>
    </div>
    <nav class="nav nav-pills nav-fill bg-light">
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}">Portada</a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/contents">Contenidos</a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/activities">Actividades</a>
      <a class="nav-item nav-link" href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/forum">Foro</a>
    </nav>
  </div>
</div>
