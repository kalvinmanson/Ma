<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Course;
use App\Content;
use App\Activity;
use Gate;
use Auth;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index($grade, $course)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      return view('aula.activities.index', compact('course'));
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

      return view('aula.activities.create', compact('course'));
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
        'name' => ['required', 'min:10'],
        'description' => ['required', 'min:10', 'max:250']
      ]);

      $activity = new Activity;
      $activity->course_id = $course->id;
      $activity->content_id = $request->content_id;
      $activity->name = $request->name;
      //Validar unico slug
      $slug = str_slug($request->name);
      $validate = Content::where('slug', $slug)->get();
      if(count($validate) > 0) {
          $slug = $slug . '-' . rand(1000,9999);
      }
      $activity->slug = $slug;
      $activity->description = $request->description;
      $activity->fullcontent = $request->fullcontent;
      $activity->active = $request->active;
      $activity->save();

      flash('Actividad Agregada')->success();
      return redirect()->action('ActivityController@index', [$grade->slug, $course->slug]);

    }
    public function show($grade, $course, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $activity = Activity::where('slug', $slug)->where('course_id', $course->id)->first();

      return view('aula/activities/show', compact('activity', 'course'));
    }
    public function edit($grade, $course, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $activity = Activity::where('slug', $slug)->where('course_id', $course->id)->first();

      return view('aula/activities/edit', compact('activity', 'course'));
    }

    public function update($grade, $course, $slug, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $activity = Activity::where('slug', $slug)->where('course_id', $course->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }
      $this->validate(request(), [
        'name' => ['required', 'min:10'],
        'description' => ['required', 'min:10', 'max:250']
      ]);
      $activity->content_id = $request->content_id;
      $activity->name = $request->name;
      $activity->description = $request->description;
      $activity->fullcontent = $request->fullcontent;
      $activity->active = $request->active;
      $activity->save();

      flash('Actividad Actualizada')->success();
      return redirect()->action('ActivityController@index', [$grade->slug, $course->slug]);

    }
}
