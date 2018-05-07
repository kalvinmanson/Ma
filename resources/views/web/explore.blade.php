@extends('layouts.app')
@section('title', 'Explorar contenidos educativos')
@section('meta-description', 'Cursa tu bachillerato por ciclos de forma virtual en menor tiempo, consulta material educativo de sexto a once en las diferentes areas del conocimiento escolar.')
@section('canonical', '/explore')
@section('content')
  <div class="container py-3">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="bg-secondary text-white p-2">Nuevos contenidos</h4>
        @foreach($last_contents as $content)
          @include('partials.aula.contentList', ['content' => $content])
        @endforeach
      </div>
      <div class="col-sm-6">
        <h4 class="bg-secondary text-white p-2">Nuevos temas en los foros</h4>
        @foreach($last_topics as $topic)
          <a href="/g/{{ $topic->course->grade->slug }}/c/{{ $topic->course->slug }}/forum/{{ $topic->slug }}" class="list-group-item list-group-item-action">
            <strong>{{ $topic->name }}</strong><br>
            @if($topic->content)
              <small>[{{ $topic->content->name }}]</small><br>
            @endif
            <small><i class="fa fa-user"></i> {{ $topic->user->name }} <i class="fa fa-clock-o"></i> {{ $topic->created_at->diffForHumans() }}</small>
          </a>
        @endforeach
      </div>
    </div>
    <hr>
    <h1>Explorar Todos los grados</h1>

    @foreach($grades as $grade)
      <h2>{{ $grade->name }}</h2>
      <div class="row">
        @foreach($grade->courses as $course)
        <div class="col-sm-4 col-lg-3 mb-2">
          <a href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}" class="card bg-dark text-white">
            <div class="card-body">
              <img src="{{ $course->picture or '/img/no-course-pic.png'}}" class="img-fluid float-left w-25 mr-2">
              <h5 class="m-0">{{ $course->name }}</h5>
              <small>{{ $course->grade->name }}</small>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    @endforeach
  </div>
@endsection
