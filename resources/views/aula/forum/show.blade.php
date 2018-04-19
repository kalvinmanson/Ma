@extends('layouts.app')

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
  <h1 class="bg-secondary p-2 text-white">{{ $topic->name }}</h1>
  {!! $topic->fullcontent !!}
</div>
@endsection
