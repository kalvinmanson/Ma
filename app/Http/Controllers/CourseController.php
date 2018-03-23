<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Course;
use App\Post;
use App\Topic;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('web.index');
    }
    public function show($grade, $slug)
    {
      $grade = Grade::where('slug', $grade)->first();
      $course = Course::where('slug', $slug)->where('grade_id', $grade->id)->first();

      $posts = Post::where('course_id', $course->id)->paginate(10);
      $topics = Topic::where('course_id', $course->id)->limit(5);
      return view('aula/courses/show', compact('course', 'posts', 'topics'));
    }
}
