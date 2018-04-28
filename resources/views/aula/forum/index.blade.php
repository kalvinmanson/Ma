@extends('layouts.app')
@section('title', 'Foro de '.$course->name.' grado '. $course->grade->name)
@section('meta-description', 'Consulta los temas, dudas y opiniones disponibles para estudiantes de grado '. $course->grade->name.' en el área de '. $course->name)
@section('canonical', '/g/'.$course->grade->slug.'/c/'.$course->slug.'/forum')
@section('content')


@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <div class="p-3">
    @if(Gate::allows('use-course', $course))
      @include('partials.aula.topicCreate', ['course' => $course])
    @endif
    <p class="text-muted d-inline p-2">Mediante el foro puedes realizar preguntas y aportar con tus comentarios al crecimiento del curso.</p>
    <div class="clearfix"></div>
  </div>
  <table class="table table-striped">
    <tr>
      <th>Tema</th>
      <th><i class="fa fa-comments-o"></i></th>
      <th></th>
    </tr>
    @foreach($topics as $topic)
    <tr>
      <td>
        <h3 class="m-0">
          <a href="/g/{{ $topic->course->grade->slug }}/c/{{ $topic->course->slug }}/forum/{{ $topic->slug }}" title="{{ $topic->name }}">
            {{ $topic->name }}
          </a>
        </h3>
        <small>
          <i class="fa fa-user"></i> {{ $topic->user->name }}
          @if($topic->content)
            {{ $topic->content->name }}
          @endif
        </small>
      </td>
      <td>{{ $topic->replies->count() }}</td>
      <td>{{ $topic->created_at->diffForHumans() }}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
