<?php

namespace App\Http\Controllers;
use App\Vote;
use App\Content;
use App\Activity;
use App\Question;
use App\Topic;
use App\Reply;
use App\Post;
use Auth;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
      //validate
      if($request->content_id > 0) { $voted = Vote::where('user_id', Auth::user()->id)->where('content_id', $request->content_id)->first(); }
      elseif($request->activity_id > 0) { $voted = Vote::where('user_id', Auth::user()->id)->where('activity_id', $request->activity_id)->first(); }
      elseif($request->question_id > 0) { $voted = Vote::where('user_id', Auth::user()->id)->where('question_id', $request->question_id)->first(); }
      elseif($request->topic_id > 0) { $voted = Vote::where('user_id', Auth::user()->id)->where('topic_id', $request->topic_id)->first(); }
      elseif($request->reply_id > 0) { $voted = Vote::where('user_id', Auth::user()->id)->where('reply_id', $request->reply_id)->first(); }
      elseif($request->post_id > 0) { $voted = Vote::where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->first(); }
      else {
        flash('No se selecciono un contenido a votar')->error();
        return redirect()->back();
      }
      // si ya voto
      if($voted) {
        flash('Ya se habia registrado un voto previo a este contenido')->error();
        return redirect()->back();
      }

      //create vote
      $vote = new Vote;
      $vote->user_id = Auth::user()->id;
      $vote->content_id = $request->content_id;
      $vote->activity_id = $request->activity_id;
      $vote->question_id = $request->question_id;
      $vote->topic_id = $request->topic_id;
      $vote->reply_id = $request->reply_id;
      $vote->post_id = $request->post_id;
      $vote->rank = $request->rank;
      $vote->save();

      //recalculate
      if($request->content_id > 0) { $object = Content::find($request->content_id); }
      elseif($request->activity_id > 0) { $object = Activity::find($request->activity_id); }
      elseif($request->question_id > 0) { $object = Question::find($request->question_id); }
      elseif($request->topic_id > 0) { $object = Topic::find($request->topic_id); }
      elseif($request->reply_id > 0) { $object = Reply::find($request->reply_id); }
      elseif($request->post_id > 0) { $object = Post::find($request->post_id); }

      if($object) {
          $object->rank = $object->votes->sum('rank') / $object->votes->count();
          $object->save();
      }

      flash('Tu calificación ha sido registrada')->success();
      return redirect()->back();

    }

}
