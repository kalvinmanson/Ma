@extends('layouts.app')

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <div class="row">
    <div class="col-md-7">
      <h5 class="d-block bg-secondary p-2 text-white">Contenidos del curso</h5>
      @foreach($course->contents as $content)
        @include('partials.aula.contentList', ['content' => $content])
      @endforeach
    </div>
    <div class="col-md-5">
      <h5 class="d-block bg-secondary p-2 text-white">Noticias y novedades</h5>
      @if(Gate::allows('admin-course', $course))
        @include('partials.aula.postCreate', ['course' => $course])
      @endif
      @foreach($posts as $post)
        @include('partials.aula.postList', ['post' => $post])
      @endforeach
      <h5 class="d-block bg-secondary p-2 text-white">Temas en los foros</h5>
      <p>Estos son los últimos post publicados en el foro por los estudiantes de este curso.</p>
      @foreach($topics as $topic)

      @endforeach
    </div>

  </div>

</div>
@endsection
