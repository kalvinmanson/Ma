@extends('layouts.app')
@section('title', 'Editar contenido')
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])

<div class="container-fluid">
  <h1 class="title">Actualizar: {{ $content->name }}</h1>
  <form method="POST" action="{{ url('/g/'.$course->grade->slug.'/c/'.$course->slug.'/contents/'.$content->slug) }}">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-9 col-md-10">
      <div class="form-group">
        <label for="name">Título del contenido</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="ej. Todo sobre la célula" value="{{ old('name') ? old('name') : $content->name }}">
      </div>
    </div>
    <div class="col-3 col-md-2">
      <div class="form-group">
        <label for="weight"># Unidad</label>
        <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight') ? old('weight') : $content->weight }}">
      </div>
    </div>
  </div>

  <div class="form-group">
      <label for="picture">Imagen destacada</label>
      <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/content" value="{{ old('picture') ? old('picture') : $content->picture }}">
  </div>
  <div class="form-group">
      <label for="description">Descripción</label>
      <textarea class="form-control" id="description" name="description" placeholder="Una descripción de entre 30 y 250 caracteres">{{ old('description') ? old('description') : $content->description }}</textarea>
  </div>
  <div class="form-group">
      <label for="fullcontent">Contenido</label>
      <textarea name="fullcontent" id="fullcontent" class="form-control">{{ old('fullcontent') ? old('fullcontent') : $content->fullcontent }}</textarea>
      <script type="text/javascript">
          var editor = CKEDITOR.replace('fullcontent');
      </script>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar cambios</button>

  </form>
</div>
@endsection
