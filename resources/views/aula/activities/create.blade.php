@extends('layouts.app')
@section('title', 'Agregar actividad')
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])

<div class="container-fluid">
  <h1 class="title">Crear Actividad</h1>
  <form method="POST" action="{{ url('/g/'.$course->grade->slug.'/c/'.$course->slug.'/activities') }}">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-9 col-md-10">
      <div class="form-group">
        <label for="content_id">Contenido al que pertenece</label>
        <select name="content_id" id="content_id" class="form-control">
          @foreach($course->contents as $content)
          <option value="{{ $content->id }}" {{ $content_id == $content->id ? 'selected' : '' }}>{{ $content->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-3 col-md-2">
      <div class="form-group">
        <label for="active">Estado</label>
        <select name="active" id="active" class="form-control">
          <option value="0">Inactiva</option>
          <option value="1">Activa</option>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="name">Título de la actividad</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Realiza esta actividad" value="{{ old('name') ? old('name') : '' }}">
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

  <button type="submit" class="btn btn-primary btn-raised"><i class="fa fa-save"></i> Crear nueva actividad</button>

  </form>
</div>
@endsection
