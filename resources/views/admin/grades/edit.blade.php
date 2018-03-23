@extends('layouts.admin')

@section('content')
<h1>Grades: Edit {{ $grade->name }}</h1>

<div class="row">
  <div class="col-sm-8">
    <table class="table table-striped">
      <tr>
        <th>Name</th>
        <th>Contents</th>
        <th>Topics/Replies</th>
        <th>Activities</th>
        <th>Posts</th>
      </tr>
      @foreach($grade->courses as $course)
      <tr>
        <td>
          <a href="/g/{{ $course->grade->slug }}/c/{{ $course->slug }}" target="_blank">{{ $course->name }}</a>
          <small><a href="/admin/courses/{{ $course->id}}/edit">Edit</a></small>
        </td>
        <td>{{ $course->contents->count() }}</td>
        <td>{{ $course->topics->count() }} / {{ $course->replies->count() }}</td>
        <td>{{ $course->activities->count() }}</td>
        <td>{{ $course->posts->count() }}</td>
      </tr>
      @endforeach
    </table>
    <div class="card border-0">
      <div class="card-header">Add new course</div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/courses') }}">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="picture">Picture</label>
                <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/page">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <input type="hidden" name="grade_id" value="{{ $grade->id }}">
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <form method="POST" action="{{ url('admin/blocks/' . $grade->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $grade->name }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
  </div>
</div>

@endsection
