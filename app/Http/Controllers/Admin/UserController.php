<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Enrollment;
use App\Course;
use App\Grade;
use Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$users = User::all();
    	return view('admin.users.index', compact('users'));
    }

    public function edit($id) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
      $user = User::find($id);
      $courses = Course::all();
      $grades = Grade::all();
      return view('admin.users.edit', compact('user', 'courses', 'grades'));
    }

    public function update($id, Request $request) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
      $user = User::find($id);
      $this->validate(request(), [
          'name' => ['required', 'max:100']
      ]);
      $user->name = $request->name;
      $user->role = $request->role;
      $user->grade_id = $request->grade_id;

      //enrollments
      $user->enrollments()->delete();
      if(isset($request->courses)) {
        foreach($request->courses as $course) {
          $enrollment = new Enrollment;
          $enrollment->user_id = $user->id;
          $enrollment->course_id = $course;
          $enrollment->save();
        }
      }
      if(isset($request->coursesTeacher)) {
        foreach($request->coursesTeacher as $course) {
          $precourser = $user->enrollments->where('course_id', $course)->first();
          if($precourser) {
            $precourser->role = 'Teacher';
            $precourser->save();
          } else {
            $enrollment = new Enrollment;
            $enrollment->user_id = $user->id;
            $enrollment->course_id = $course;
            $enrollment->role = 'Teacher';
            $enrollment->save();
          }
        }
      } // end enrollments



      $user->save();
      flash('Record updated')->success();
      return redirect()->action('Admin\UserController@index');
    }
}
