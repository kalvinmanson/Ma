<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Course;
use App\Content;
use Gate;
use Auth;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index($grade, $course)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      return view('aula.contents.index', compact('course'));
    }
    public function create($grade, $course)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }

      return view('aula.contents.create', compact('course'));
    }
    public function store($grade, $course, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }

      $this->validate(request(), [
        'name' => ['required', 'min:20'],
        'description' => ['required', 'min:50', 'max:250']
      ]);

      $content = new Content;
      $content->course_id = $course->id;
      $content->name = $request->name;
      $content->weight = $request->weight;
      //Validar unico slug
      $slug = str_slug($request->name);
      $validate = Content::where('slug', $slug)->get();
      if(count($validate) > 0) {
          $slug = $slug . '-' . rand(1000,9999);
      }
      $content->slug = $slug;
      $content->description = $request->description;
      $content->picture = $request->picture;
      $content->fullcontent = $request->fullcontent;
      $content->save();

      flash('Contenido Agregado')->success();
      return redirect()->action('ContentController@index', [$grade->slug, $course->slug]);

    }
    public function show($grade, $course, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $content = Content::where('slug', $slug)->where('course_id', $course->id)->first();

      return view('aula/contents/show', compact('content', 'course'));
    }
    public function edit($grade, $course, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $content = Content::where('slug', $slug)->where('course_id', $course->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }

      return view('aula/contents/edit', compact('content', 'course'));
    }
    public function update($grade, $course, $slug, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $content = Content::where('slug', $slug)->where('course_id', $course->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }

      $this->validate(request(), [
        'name' => ['required', 'min:20'],
        'description' => ['required', 'min:50', 'max:250']
      ]);

      $content->name = $request->name;
      $content->weight = $request->weight;
      $content->description = $request->description;
      $content->picture = $request->picture;
      $content->fullcontent = $request->fullcontent;
      $content->save();

      flash('Contenido Actualizado')->success();
      return redirect()->action('ContentController@index', [$grade->slug, $course->slug]);

    }
}
