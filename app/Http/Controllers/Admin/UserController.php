<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Enrollment;
use App\Course;
use App\Grade;
use Auth;
use Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$users = User::all();
    	return view('admin.users.index', compact('users'));
    }

    public function store(Request $request) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
      $this->validate(request(), [
        'name' => ['required', 'max:150'],
        'username' => ['required', 'unique:users', 'max:100'],
        'password' => ['required', 'max:100'],
        'email' => ['required', 'unique:users']
      ]);

      $user = new User;
      $user->name = $reques->name;
      $user->username = $reques->username;
      $user->email = $reques->email;
      $user->password = Hash::make($request->password);
      $user->grade = Grade::first();
      $user->save();
      flash('Record created')->success();
      return redirect()->action('Admin\UserController@index');
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
