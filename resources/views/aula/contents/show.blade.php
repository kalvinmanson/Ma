@extends('layouts.app')

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <h1>{{ $content->name }}</h1>
  <div class="row">
    <div class="col-sm-4">
      <img src="{{ $content->picture }}" class="img-fluid" alt="{{ $content->name }}">
    </div>
    <div class="col-sm-8">
      <p>{{ $content->description }}</p>
    </div>
  </div>
  {!! $content->content !!}
</div>
@endsection
