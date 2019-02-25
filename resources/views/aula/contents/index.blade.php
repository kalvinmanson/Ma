@extends('layouts.app')
@section('title', 'Contenidos de '.$course->name.' en grado '. $course->grade->name)
@section('meta-description', 'Consulta los cointenidos disponibles para estudiantes de grado '. $course->grade->name.' en el área de '. $course->name)
@section('canonical', '/g/'.$course->grade->slug.'/c/'.$course->slug.'/contents')
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container-fluid py-2">
  <div class="row">
    @foreach($course->contents as $content)
    <div class="col-md-6 col-lg-4 mb-2">
      <div class="card">
        <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}" title="{{ $content->name }}">
          <img class="card-img-top" src="{{ $content->picture }}" alt="{{ $content->name }}">
        </a>
        <div class="card-body">
          <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}" title="{{ $content->name }}">
            <h5 class="card-title">{{ $content->name }}</h5>
          </a>
          <p class="card-text">{{ $content->description }}.</p>
        </div>
      </div>
    </div>
    @endforeach
    @if(Gate::allows('admin-course', $course))
      <div class="col-md-6 col-lg-4 text-center py-4">
        <a href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/contents/create" class="btn btn-lg btn-primary btn-raised">
          <i class="fa fa-plus"></i> Agregar Tema
        </a>
      </div>
    @endif
  </div>
</div>
@endsection
