<?php

namespace App\Http\Controllers;
use App\Category;
use App\Page;
use App\Grade;
use App\Content;
use App\Topic;
use App\Activity;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
      return view('web.index');
    }
    public function sitemap() {
      $grades = Grade::all();
      $contents = Content::all();
      $activities = Activity::all();
      $topics = Topic::all();
      return response()->view('web.sitemap', compact('grades', 'contents', 'activities', 'topics'), 200)
      ->header('Content-Type', 'text/xml');
    }
    public function explore() {
      $grades = Grade::all();
      $last_contents = Content::orderBy('created_at', 'desc')->limit(5)->get();
      $last_topics = Topic::orderBy('created_at', 'desc')->limit(5)->get();
      $last_activities = Activity::orderBy('created_at', 'desc')->limit(5)->get();
      return view('web.explore', compact('grades', 'last_contents', 'last_topics', 'last_activities'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $pages = Page::where('category_id', $category->id)->paginate(12);
        if(view()->exists('web/cat-'.$slug)) {
            return view('web/cat-'.$slug, compact('category', 'pages'));
        } else {
            return view('web/cat', compact('category', 'pages'));
        }
    }
    public function page($category, $slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (view()->exists('web.page-cat-'.$category)) {
            return view('web/page-cat-'.$category, compact('page'));
        } else {
            return view('web/page', compact('page'));
        }
    }
}
