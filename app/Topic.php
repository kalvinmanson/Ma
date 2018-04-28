<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
  public function user()
  {
      return $this->belongsTo('App\User');
  }
  public function course()
  {
      return $this->belongsTo('App\Course');
  }
  public function content()
  {
      return $this->belongsTo('App\Content');
  }
  public function replies()
  {
      return $this->hasMany('App\Reply');
  }
  public function votes()
  {
      return $this->hasMany('App\Vote');
  }
}
