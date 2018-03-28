<?php

namespace App\Http\Controllers;
use App\User;
use App\Contact;
use Auth;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(request(), [
            'subject' => ['required', 'max:200'],
            'fullcontent' => ['required', 'max:200']
        ]);

        if(!Auth::check()) {
            $this->validate(request(), [
                'name' => ['required', 'max:200'],
                'email' => ['required', 'max:200']
            ]);
        }

    	dd($request);
    }
}
