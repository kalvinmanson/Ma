@extends('layouts.app')
@section('title', 'Instituto Moderno Americano Virtual')
@section('meta-description', 'Cursa tu bachillerato por ciclos de forma virtual en menor tiempo, consulta material educativo de sexto a once en las diferentes areas del conocimiento escolar.')
@section('canonical', '/')
@section('content')
<div class="container-fluid pt-3">
  @if(Auth::check())
    <div class="row">
    @foreach(Auth::user()->enrollments as $enrollment)
      <div class="col-sm-4 col-lg-3 mb-2">
        <a href="/g/{{ $enrollment->course->grade->slug }}/c/{{ $enrollment->course->slug }}" class="card bg-dark text-white">
          <div class="card-body">
            <img src="{{ $enrollment->course->picture or '/img/no-course-pic.png'}}" class="img-fluid float-left w-25 mr-2">
            <h5 class="m-0">{{ $enrollment->course->name }}</h5>
            <small>{{ $enrollment->course->grade->name }} ({{ $enrollment->role }})</small>
          </div>
        </a>
      </div>
    @endforeach
    </div>
  @else
    <div class="row">
      <div class="col-sm-6">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/7LA9siyUUck?rel=0" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-sm-6">
        <h1 class="title"><span>Bienvenido a, </span>Instituto Moderno Americano <span>Virtual y a distancia.</span></h1>
        <p>La plataforma del Instituto Moderno Americano (IMA) Virtual y a distancia, te permite continuar tus estudios en educación básica y media desde cualquier lugar, apoyate en la comunidad para crear un proyecto de vida profesional y crecer en tu vida.</p>
        <p class="text-center">
          <a href="/login/google" class="btn btn-primary btn-lg"><i class="fa fa-google"></i> Ingresar</a><br>
          <a href="#">No se cual es mi cuenta</a><br>
          <a href="#">Quiero matricularme</a>
        </p>
      </div>
    </div>
    @endif
    <hr>
    @if($home)
    <h1 class="text-center title">{{ $home->name }}</h1>
    <div class="row">
      <div class="col-sm-5">
         {!! $home->fullcontent !!}
      </div>
      <div class="col-sm-7">
        <img src="{{ $home->picture }}" class="img-fluid">
      </div>
    </div>
    @endif
</div>
@endsection
