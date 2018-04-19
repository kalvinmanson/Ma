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
  public function replies()
  {
      return $this->hasMany('App\Reply');
  }
}
