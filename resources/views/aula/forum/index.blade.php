@extends('layouts.app')

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
      <th>Fecha</th>
    </tr>
    @foreach($topics as $topic)
    <tr>
      <td>
        <a href="/g/{{ $topic->course->grade->slug }}/c/{{ $topic->course->slug }}/forum/{{ $topic->slug }}" title="{{ $topic->name }}">
          {{ $topic->name }}
        </a><br>
        <small>
          <i class="fa fa-user"></i> {{ $topic->user->name }}
          @if($topic->content)
            {{ $topic->content->name }}
          @endif
        </small>
      </td>
      <td>{{ $topic->replies->count() }}</td>
      <td>Fecha</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
