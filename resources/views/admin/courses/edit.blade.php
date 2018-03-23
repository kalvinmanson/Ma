@extends('layouts.admin')

@section('content')
    <h1>Course: Edit {{ $course->name }}</h1>
    <form method="POST" action="{{ url('admin/courses/' . $course->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $course->name }}">
              </div>
              <div class="form-group">
                  <label for="picture">Picture</label>
                  <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/category" value="{{ old('picture') ? old('picture') : $course->picture }}">
              </div>
              <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" placeholder="Describe your category">{{ old('description') ? old('description') : $course->description }}</textarea>
              </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>

    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.courses.destroy', $course->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}

@endsection
