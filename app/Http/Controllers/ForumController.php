<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Course;
use App\Content;
use App\Topic;
use App\Reply;
use Gate;
use Auth;

use Illuminate\Http\Request;

class ForumController extends Controller
{
  public function reply($grade, $course, $slug, Request $request) {
    $grade = Grade::where('slug', $grade)->first();
    $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
    $topic = Topic::where('slug', $slug)->where('course_id', $course->id)->first();

    //validar permisos
    if(!Gate::allows('admin-course', $course)) {
      flash('No tienes permisos para realizar esta accion')->error();
      return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
    }

    $reply = new Reply;
    $reply->topic_id = $topic->id;
    $reply->user_id = Auth::user()->id;
    $reply->fullcontent = $request->fullcontent;
    $reply->save();

    flash('Respuesta enviada')->success();
    return redirect()->action('ForumController@show', [$grade->slug, $course->slug, $topic->slug]);
  }
  public function index($grade, $course)
  {
    $grade = Grade::where('slug', $grade)->first();
    $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
    $topics = Topic::where('course_id', $course->id)->orderBy('created_at', 'desc')->paginate(20);
    return view('aula.forum.index', compact('course', 'topics'));
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
      'fullcontent' => ['required', 'min:50']
    ]);

    $topic = new Topic;
    $topic->course_id = $course->id;
    $topic->content_id = $request->content_id;
    $topic->user_id = Auth::user()->id;
    $topic->name = $request->name;
    //Validar unico slug
    $slug = str_slug($request->name);
    $validate = Topic::where('slug', $slug)->get();
    if(count($validate) > 0) {
        $slug = $slug . '-' . rand(1000,9999);
    }
    $topic->slug = $slug;
    $topic->fullcontent = $request->fullcontent;
    $topic->save();

    flash('Tema agregado')->success();
    return redirect()->action('ForumController@index', [$grade->slug, $course->slug]);

  }
  public function show($grade, $course, $slug)
  {
    $grade = Grade::where('slug', $grade)->first();
    $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
    $topic = Topic::where('slug', $slug)->where('course_id', $course->id)->first();

    return view('aula/forum/show', compact('topic', 'course'));
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
