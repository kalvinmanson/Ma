@extends('layouts.app')
@section('title', 'Bienvenido a Drodmin')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
  @if(Auth::check())
    <div class="row">
    @foreach(Auth::user()->enrollments as $enrollment)
      <div class="col-sm-4 col-lg-3 mb-2">
        <a href="/g/{{ $enrollment->course->grade->slug }}/c/{{ $enrollment->course->slug }}" class="card bg-dark text-white">
          <div class="card-body">
            <img src="{{ $enrollment->course->picture or '/img/no-course-pic.png'}}" class="img-fluid float-left w-25 mr-2">
            <h5>{{ $enrollment->course->name }}</h5>
            <small>{{ $enrollment->course->grade->name }}</small>
          </div>
        </a>
      </div>
    @endforeach
    </div>
  @else
    <div class="row">
      <div class="col-sm-6">
        <img src="/img/pics/home.jpg" class="img-fluid">
      </div>
      <div class="col-sm-6">
        <h1 class="title"><span>Bienvenido a, </span>Moderno Americano <span>Virtual y a distancia.</span></h1>
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

    <h2 class="text-center title"><span>¿Cómo funciona el</span> Moderno Americano Virtual?</h1>
    <div class="row">
      <div class="col-sm-5">
        <h4>Foros de discusión</h4>
        <p>Cada asignatura cuenta con un foro abierto en el que puedes conocer a tus compañeros y construir con ellos nuevo conocimiento en torno a los temas tratados en clase, si tienes una duda puedes publicarla y así aportar a la resolución de preguntas que son útiles para toda la comunidad.</p>

        <h4>Chats y clases en vivo</h4>
        <p>Comparte de clases en video en vivo apoyadas con tecnologías como HangOuts de Google para que puedas participar en tiempo real de los contenidos de la asignatura pero también teniéndolos disponibles en diferido.</p>

        <h4>Temas y actividades</h4>
        <p>Los contenidos de las asignaturas te darán un camino organizado vinculando los temas directamente con actividades que refuercen tus conocimientos, pero tu puedes crear y compartir tu ruta de aprendizaje a tu gusto.</p>

      </div>
      <div class="col-sm-7">
        <img src="/img/pics/home01.jpeg" class="img-fluid">
      </div>
    </div>
</div>
@endsection
