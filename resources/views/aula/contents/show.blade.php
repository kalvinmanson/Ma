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
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="float-right">@include('partials.aula.voteCreate', ['object' => $content, 'content_id' => $content->id])</div>
          <p>Una vez que termines el contenido califica el mismo para que de esta manera quede marcado como leído en tu historial.  </p>
          <div class="clearfix"></div>
        </div>
      </div>

    </div>
    <div class="col-sm-4">
      <h5 class="bg-secondary p-2 text-white">
        @if(Gate::allows('admin-course', $course))
          <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/questions/create?content_id={{ $content->id }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Pregunta</a>
        @endif
        Desafíos
      </h5>
      <p class="text-muted text-center">
        Actualmente hay {{ $content->questions->count() }} preguntas de desafío para "{{ $content->name }}".
      </p>
      @if($content->questions->count() > 0)
      <p class="text-center">
        <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/questions" class="btn btn-danger">
          Realizar el desafío <i class="fa fa-angle-right"></i>
        </a>
      </p>

      @endif

      <h5 class="bg-secondary p-2 text-white">
        @if(Gate::allows('admin-course', $course))
          <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/activities/create?content_id={{ $content->id }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Actividad</a>
        @endif
        Actividades
      </h5>
      <div class="list-group">
      @foreach($content->activities as $activity)
        <a href="/g/{{ $activity->course->grade->slug }}/c/{{ $activity->course->slug }}/activities/{{ $activity->slug }}" class="list-group-item list-group-item-action">{{ $activity->name }}</a>
      @endforeach
      </div>
      <hr>
      <h5 class="bg-secondary p-2 text-white">
        @if(Gate::allows('use-course', $course))
          @include('partials.aula.topicCreate', ['course' => $course, 'content_id' => $content->id])
        @endif
        Temas en el foro
      </h5>
      <div class="clearfix"></div>
      @if($content->topics->count() > 0)
      <div class="list-group">
      @foreach($content->topics as $topic)
        <a href="/g/{{ $topic->course->grade->slug }}/c/{{ $topic->course->slug }}/forum/{{ $topic->slug }}" class="list-group-item list-group-item-action">
          <strong>{{ $topic->name }}</strong><br>
          <small><i class="fa fa-user"></i> {{ $topic->user->name }} <i class="fa fa-clock-o"></i> {{ $topic->created_at->diffForHumans() }}</small>
        </a>
      @endforeach
      </div>
      @else
      <p class="text-center text-muted">No hay temas en el foro sobre este contenido.</p>
      @endif
    </div>

  </div>
</div>
@endsection
