@if(Auth::check() && $object->votes->where('user_id', Auth::user()->id)->count() == 0)
<form method="POST" action="/vote">
  {{ csrf_field() }}
  <input type="hidden" name="content_id" value="{{ $content_id or 0 }}">
  <input type="hidden" name="activity_id" value="{{ $activity_id or 0 }}">
  <input type="hidden" name="question_id" value="{{ $question_id or 0 }}">
  <input type="hidden" name="topic_id" value="{{ $topic_id or 0 }}">
  <input type="hidden" name="reply_id" value="{{ $reply_id or 0 }}">
  <input type="hidden" name="post_id" value="{{ $post_id or 0 }}">
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="submit" name="rank" value="1" class="btn btn-sm btn-light"><span class="fa fa-star text-warning"></span> 1</button>
    <button type="submit" name="rank" value="2" class="btn btn-sm btn-light"><span class="fa fa-star text-warning"></span> 2</button>
    <button type="submit" name="rank" value="3" class="btn btn-sm btn-light"><span class="fa fa-star text-warning"></span> 3</button>
    <button type="submit" name="rank" value="4" class="btn btn-sm btn-light"><span class="fa fa-star text-warning"></span> 4</button>
    <button type="submit" name="rank" value="5" class="btn btn-sm btn-light"><span class="fa fa-star text-warning"></span> 5</button>
  </div>
</form>
@else
<div class="text-center">
  <div class="bg-light p-3 rounded d-inline">
    <i class="fa fa-star text-warning"></i> {{ $object->rank or 0 }}
  </div>
</div>
@endif
