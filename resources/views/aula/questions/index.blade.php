@extends('layouts.app')
@section('title', 'Preguntas de '.$course->name.' en grado '. $course->grade->name)
@section('meta-description', 'Consulta las actividades disponibles para estudiantes de grado '. $course->grade->name.' en el área de '. $course->name)
@section('canonical', '/g/'.$course->grade->slug.'/c/'.$course->slug.'/activities')
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container-fluid py-2">
  <div class="list-group">
  @foreach($course->questions as $question)
  <a href="/g/{{ $question->content->course->grade->slug }}/c/{{ $question->content->course->slug }}/questions/{{ $question->slug }}" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{ $question->name }}</h5>
    </div>
    <p class="mb-1">{{ $question->description }}</p>
    <p class="mb-1"><small>Contenido: {{ $question->content->name }}</small></p>
  </a>
  @endforeach
  </div>
</div>
@endsection
