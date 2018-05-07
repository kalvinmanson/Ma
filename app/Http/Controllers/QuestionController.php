<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Course;
use App\Content;
use App\Question;
use Gate;
use Auth;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index($grade, $course)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      return view('aula.questions.index', compact('course'));
    }
    public function create($grade, $course, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }
      $content_id = $request->content_id;
      return view('aula.questions.create', compact('course', 'content_id'));
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

      $question = new Question;
      $question->content_id = $request->content_id;
      $question->name = $request->name;
      //Validar unico slug
      $slug = str_slug($request->name);
      $validate = Question::where('slug', $slug)->get();
      if(count($validate) > 0) {
          $slug = $slug . '-' . rand(1000,9999);
      }
      $question->slug = $slug;
      $question->description = $request->description;
      $question->fullcontent = $request->fullcontent;
      $question->option_a = $request->option_a;
      $question->option_b = $request->option_b;
      $question->option_c = $request->option_c;
      $question->option_d = $request->option_d;
      $question->correct = $request->correct;
      $question->time = $request->time;
      $question->save();

      flash('Actividad Agregada')->success();
      return redirect()->action('QuestionController@index', [$grade->slug, $course->slug]);

    }
    public function show($grade, $course, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $question = Question::where('slug', $slug)->where('course_id', $course->id)->first();

      return view('aula/questions/show', compact('question', 'course'));
    }
    public function edit($grade, $course, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $question = Question::where('slug', $slug)->where('course_id', $course->id)->first();

      return view('aula/questions/edit', compact('activity', 'course'));
    }

    public function update($grade, $course, $slug, Request $request)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $course)->where('grade_id', $grade->id)->first();
      $question = Question::where('slug', $slug)->where('course_id', $course->id)->first();

      //validar permisos
      if(!Gate::allows('admin-course', $course)) {
        flash('No tienes permisos para realizar esta accion')->error();
        return redirect()->action('CourseController@show', [$grade->slug, $course->slug]);
      }
      $this->validate(request(), [
        'name' => ['required', 'min:10'],
        'description' => ['required', 'min:10', 'max:250']
      ]);
      $question->content_id = $request->content_id;
      $question->name = $request->name;
      $question->description = $request->description;
      $question->fullcontent = $request->fullcontent;
      $question->active = $request->active;
      $question->save();

      flash('Actividad Actualizada')->success();
      return redirect()->action('QuestionController@index', [$grade->slug, $course->slug]);

    }
}
