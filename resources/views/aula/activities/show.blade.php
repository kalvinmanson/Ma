@extends('layouts.app')

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <h1 class="bg-secondary p-2 text-white">{{ $activity->name }}</h1>
  <div class="row">
    <div class="col-sm-8">
      @if(Gate::allows('admin-course', $course))
        <p><a href="/g/{{ $activity->course->grade->slug }}/c/{{ $activity->course->slug }}/activities/{{ $activity->slug }}/edit">Editar</a></p>
      @endif

      @if($activity->active)
      {!! $activity->fullcontent !!}
      <hr>
      @if(Gate::allows('use-course', $course))
        @include('partials.aula.answerCreate', ['activity' => $activity])
      @endif
      @else
      <p>{{ $activity->description }}</p>
      <p class="text-center">Esta actividad aun no esta activa.</p>
      @endif
    </div>
    <div class="col-sm-4">
      <h4 class="bg-secondary p-2 text-white">Contenido</h4>
      <div class="card">
        <img class="card-img-top" src="{{ $activity->content->picture }}" alt="{{ $activity->content->name }}">
        <div class="card-body">
          <a href="/g/{{ $activity->content->course->grade->slug }}/c/{{ $activity->content->course->slug }}/contents/{{ $activity->content->slug }}">
            <h5 class="card-title">{{ $activity->content->name }}</h5>
          </a>
          <p class="card-text">{{ $activity->content->description }}.</p>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
