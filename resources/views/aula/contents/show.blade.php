@extends('layouts.app')
@section('title', 'Contenido | '.$content->name. ' | '.$content->course->name.' grado '.$content->course->grade->name)
@section('meta-description', $content->description)
@section('canonical', '/g/'.$course->grade->slug.'/c/'.$course->slug.'/contents/'.$content->slug)

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <h1 class="bg-secondary p-2 text-white">{{ $content->name }}</h1>
  <div class="row">
    <div class="col-sm-8">
      @if(Gate::allows('admin-course', $course))
        <p><a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}/edit">Editar</a></p>
      @endif
      {!! $content->fullcontent !!}
    </div>
    <div class="col-sm-4">
      <h5 class="bg-secondary p-2 text-white">
        @if(Gate::allows('admin-course', $course))
          <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/activities/create" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Actividad</a>
        @endif
        Actividades
        <div class="clearfix"></div>
      </h5>
      <div class="list-group">
      @foreach($content->activities as $activity)
        <a href="/g/{{ $activity->course->grade->slug }}/c/{{ $activity->course->slug }}/activities/{{ $activity->slug }}" class="list-group-item list-group-item-action">{{ $activity->name }}</a>
      @endforeach
      </div>
      <hr>
      <h5 class="bg-secondary p-2 text-white">
        @if(Gate::allows('use-course', $course))
          <a href="#" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Nuevo tema</a>
        @endif
        Temas en el foro
        <div class="clearfix"></div>
      </h5>
      <div class="list-group">
      @foreach($content->topics as $topic)
        <a href="/g/{{ $topic->course->grade->slug }}/c/{{ $topic->course->slug }}/forum/{{ $topic->slug }}" class="list-group-item list-group-item-action">{{ $topic->name }}</a>
      @endforeach
      </div>
    </div>

  </div>
</div>
@endsection
