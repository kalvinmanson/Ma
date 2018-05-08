@extends('layouts.admin')

@section('content')
    <h1>Countries: Edit {{ $user->name }}</h1>
    <form method="POST" action="{{ url('admin/users/' . $user->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $user->name }}">
                </div>
                <div class="form-group">
                    <label for="domain">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Admin" {{ $user->role == "Admin" ? 'selected' : '' }}>Admin</option>
                        <option value="Teacher" {{ $user->role == "Teacher" ? 'selected' : '' }}>Teacher</option>
                        <option value="User" {{ $user->role == "User" ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="grade_id">Grade</label>
                    <select name="grade_id" id="grade_id" class="form-control">
                        @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ $grade->id == $user->grade_id ? 'selected' : '' }}>{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <div class="col-md-4">
              <h5>Cursos de estudiante</h5>
                @foreach($courses as $course)
                <div class="form-check">
                  <input class="form-check-input" name="courses[]" type="checkbox" value="{{ $course->id }}" id="course_{{ $course->id }}" {{ $user->enrollments->where('course_id', $course->id)->where('role', 'Student')->first() ? 'checked' : ''}}>
                  <label class="form-check-label" for="course_{{ $course->id }}">
                    {{ $course->grade->name }} / {{ $course->name }}
                  </label>
                </div>
                @endforeach
                <h5>Cursos de docente</h5>
                  @foreach($courses as $course)
                  <div class="form-check">
                    <input class="form-check-input" name="coursesTeacher[]" type="checkbox" value="{{ $course->id }}" id="courseT_{{ $course->id }}" {{ $user->enrollments->where('course_id', $course->id)->where('role', 'Teacher')->first() ? 'checked' : ''}}>
                    <label class="form-check-label" for="courseT_{{ $course->id }}">
                      {{ $course->grade->name }} / {{ $course->name }}
                    </label>
                  </div>
                  @endforeach
            </div>
        </div>
    </form>
@endsection
