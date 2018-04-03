@extends('layouts.app')

@section('content')

@include('partials.aula.courseHeader', ['course' => $course])

<div class="container">
  <h1 class="title">Crear contenido</h1>
  <form method="POST" action="{{ url('/g/'.$course->grade->slug.'/c/'.$course->slug.'/contents') }}">
  {{ csrf_field() }}
  <div class="form-group">
      <label for="name">Título del contenido</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="ej. Todo sobre la célula" value="{{ old('name') ? old('name') : '' }}">
  </div>
  <div class="form-group">
      <label for="picture">Imagen destacada</label>
      <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/content" value="{{ old('picture') ? old('picture') : '' }}">
  </div>
  <div class="form-group">
      <label for="description">Descripción</label>
      <textarea class="form-control" id="description" name="description" placeholder="Una descripción de entre 30 y 250 caracteres">{{ old('description') ? old('description') : '' }}</textarea>
  </div>
  <div class="form-group">
      <label for="fullcontent">Contenido</label>
      <textarea name="fullcontent" id="fullcontent" class="form-control">{{ old('fullcontent') ? old('fullcontent') : '' }}</textarea>
      <script type="text/javascript">
          var editor = CKEDITOR.replace('fullcontent');
      </script>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Crear nuevo contenido</button>

  </form>
</div>
@endsection
