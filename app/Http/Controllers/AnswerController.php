<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Course;
use App\Content;
use App\Activity;
use App\Answer;
use Gate;
use Auth;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index($grade, $course, $activity)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      return view('aula.activities.index', compact('course'));
    }

    public function store($grade, $course, $slug, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $activity = Activity::where('slug', $slug)->where('course_id', $course->id)->first();

      //validar permisos
      if(!Gate::allows('use-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }

      $this->validate(request(), [
        'fullcontent' => ['required']
      ]);

      $answer = new Answer;
      $answer->activity_id = $activity->id;
      $answer->user_id = Auth::user()->id;
      $answer->attached = $request->attached;
      $answer->fullcontent = $request->fullcontent;

      $answer->save();

      flash('Respuesta enviada')->success();
      return redirect()->action('ActivityController@show', [$grade->slug, $course->slug, $activity->slug]);

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
        'name' => ['required', 'min:20'],
        'description' => ['required', 'min:50', 'max:250']
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
