<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{

    public function store(Request $request) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
  	  $this->validate(request(), [
          'name' => ['required', 'max:100'],
          'grade_id' => ['required']
      ]);

      //Validar unico slug
      $slug = str_slug($request->name);
      $validate = Course::where('slug', $slug)->get();
      if(count($validate) > 0) {
        $slug = $slug . '-' . rand(100,999);
      }

      $course = new Course;
      $course->grade_id = $request->grade_id;
      $course->name = $request->name;
      $course->slug = $slug;
      $course->picture = $request->picture;
      $course->description = $request->description;
      $course->save();

      flash('Record created')->success();
      return redirect()->action('Admin\GradeController@edit', $request->grade_id);

    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $course = Course::find($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }

        $course = Course::find($id);

        $this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);

        $course->name = $request->name;
        $course->picture = $request->picture;
        $course->description = $request->description;
        $course->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\GradeController@edit', $course->grade->id);
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $course = Course::find($id);
        Course::destroy($course->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\CourseController@index');
    }
}
