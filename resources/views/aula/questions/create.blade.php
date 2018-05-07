@extends('layouts.app')
  @section('title', 'Agregar pregunta')
@section('content')

@include('partials.aula.courseHeader', ['course' => $course])

<div class="container">
  <h1 class="title">Crear pregunta para desafío</h1>
  <form method="POST" action="{{ url('/g/'.$course->grade->slug.'/c/'.$course->slug.'/questions') }}">
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
        <label for="time">Tiempo (min)</label>
        <input type="number" name="time" id="time" min="1" max="10" value="5" required class="form-control">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="name">Titulo de la pregunta</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Los animales y los ecosistemas" value="{{ old('name') ? old('name') : '' }}" required>
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
  <h4>Respuestas posibles (selecciona la respuesta correcta)</h4>
  <div class="row">
    <div class="col-sm-6">
      <label for="option_a">Opción A</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
          <input type="radio" name="correct" value="1" required>
          </div>
        </div>
        <input type="text" name="option_a" id="option_a" class="form-control" value="{{ old('option_a') ? old('option_a') : '' }}" required>
      </div>
    </div>
    <div class="col-sm-6">
      <label for="option_b">Opción B</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
          <input type="radio" name="correct" value="2" required>
          </div>
        </div>
        <input type="text" name="option_b" id="option_b" class="form-control" value="{{ old('option_b') ? old('option_b') : '' }}" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <label for="option_c">Opción C</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
          <input type="radio" name="correct" value="3" required>
          </div>
        </div>
        <input type="text" name="option_c" id="option_c" class="form-control" value="{{ old('option_c') ? old('option_c') : '' }}" required>
      </div>
    </div>
    <div class="col-sm-6">
      <label for="option_d">Opción D</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
          <input type="radio" name="correct" value="4" required>
          </div>
        </div>
        <input type="text" name="option_d" id="option_d" class="form-control" value="{{ old('option_d') ? old('option_d') : '' }}" required>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-save"></i> Crear nueva pregunta</button>

  </form>
</div>
@endsection
