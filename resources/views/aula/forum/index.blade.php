@extends('layouts.app')

@section('content')


@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  @include('partials.aula.topicCreate', ['course' => $course])
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
          Por: {{ $topic->user->name }}
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
