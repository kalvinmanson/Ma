@extends('layouts.app')
@section('title', 'Tema | '.$topic->name. ' | '.$topic->course->name.' grado '.$topic->course->grade->name)
@section('meta-description', $topic->name.' agregado por '.$topic->user->name)
@section('canonical', '/g/'.$course->grade->slug.'/c/'.$course->slug.'/forum/'.$topic->slug)
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])
<div class="container py-2">
    <h1 class="bg-secondary p-2 text-white">{{ $topic->name }}</h1>
    <div class="card mb-3 pb-0">
      <div class="card-body">
        {!! $topic->fullcontent !!}
        <p class="text-muted"><i class="fa fa-user"></i> {{ $topic->user->name }} | <i class="fa fa-clock-o"></i> {{ $topic->created_at }}</p>
      </div>
    </div>
    @foreach($topic->replies as $reply)
    <div class="card mb-3">
      <div class="card-body pb-0">
        {!! $reply->fullcontent !!}
        <p class="text-muted"><i class="fa fa-user"></i> {{ $reply->user->name }} | <i class="fa fa-clock-o"></i> {{ $reply->created_at }}</p>
      </div>
    </div>
    @endforeach
    @if(Gate::allows('use-course', $course))
      @include('partials.aula.replyCreate', ['topic' => $topic])
    @endif
</div>
@endsection
