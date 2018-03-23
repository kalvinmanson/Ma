<?php

namespace App\Http\Controllers;
use App\Course;
use App\Grade;
use App\Post;
use Gate;
use Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store($grade, $slug, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $slug)->where('grade_id', $grade->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }

      $this->validate(request(), [
        'name' => ['required', 'min:30']
      ]);

      $post = new Post;
      $post->user_id = Auth::user()->id;
      $post->course_id = $course->id;
      $post->name = $request->name;
      $post->save();

      flash('Noticia agregada')->success();
      return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
    }
    public function destroy($grade, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $slug)->where('grade_id', $grade->id)->first();
      return view('aula/courses/show', compact('course'));
    }
}
