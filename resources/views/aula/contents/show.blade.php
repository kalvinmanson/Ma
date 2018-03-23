@extends('layouts.app')

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <div class="row">
    @if(Auth::check() && Auth::user()->enrollments->where('course_id', $course->id)->where('role', 'Teacher')->first())
      <div class="col-md-6 col-lg-4 text-center py-4">
        <a href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}/contents/new" class="btn btn-lg btn-primary">
          <i class="fa fa-plus"></i> Agregar Tema
        </a>
      </div>
    @endif
    @foreach($course->contents as $content)
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <img class="card-img-top" src="{{ $content->picture }}" alt="{{ $content->name }}">
        <div class="card-body">
          <a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}">
            <h5 class="card-title">{{ $content->name }}</h5>
          </a>
          <p class="card-text">{{ $content->description }}.</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
