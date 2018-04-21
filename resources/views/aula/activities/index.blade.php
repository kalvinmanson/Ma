@extends('layouts.app')
@section('title', 'Actividades de '.$course->name.' en grado '. $course->grade->name)
@section('meta-description', 'Consulta las actividades disponibles para estudiantes de grado '. $course->grade->name.' en el área de '. $course->name)
@section('canonical', '/g/'.$course->grade->slug.'/c/'.$course->slug.'/activities')
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <div class="list-group">
  @foreach($course->activities as $activity)
  <a href="/g/{{ $activity->course->grade->slug }}/c/{{ $activity->course->slug }}/activities/{{ $activity->slug }}" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{ $activity->name }}</h5>
    </div>
    <p class="mb-1">{{ $activity->description }}</p>
    <p class="mb-1"><small>Contenido: {{ $activity->content->name }}</small></p>
  </a>
  @endforeach
  </div>
</div>
@endsection
