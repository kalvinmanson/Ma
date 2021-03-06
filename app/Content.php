<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  public function course()
  {
      return $this->belongsTo('App\Course');
  }
  public function activities()
  {
      return $this->hasMany('App\Activity');
  }
  public function topics()
  {
      return $this->hasMany('App\Topic');
  }
  public function votes()
  {
      return $this->hasMany('App\Vote');
  }
  public function questions()
  {
      return $this->hasMany('App\Question');
  }
}
