<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Grade;
use App\User;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
    {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$grades = Grade::orderBy('updated_at', 'desc')->get();
    	return view('admin.grades.index', compact('grades'));
    }
    public function store(Request $request) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
  	  $this->validate(request(), [
          'name' => ['required', 'max:100']
      ]);

      //Validar unico slug
      $slug = str_slug($request->name);
      $validate = Grade::where('slug', $slug)->get();
      if(count($validate) > 0) {
        $slug = $slug . '-' . count($validate);
      }

      $grade = new Grade;
      $grade->name = $request->name;
      $grade->slug = $slug;
      $grade->save();

      flash('Record created')->success();
      return redirect()->action('Admin\GradeController@index');

    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $grade = Grade::find($id);
        return view('admin.grades.edit', compact('grade'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }

        $grade = Grade::find($id);

        $this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);

        $grade->name = $request->name;
        $grade->format = $request->format;
        $grade->picture = $request->picture;
        $grade->description = $request->description;
        $grade->content = $request->content;
        $grade->weight = $request->weight;
        $grade->link = $request->link;
        $grade->style = $request->style;
        $grade->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\GradeController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $grade = Grade::find($id);
        Grade::destroy($grade->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\GradeController@index');
    }
}
