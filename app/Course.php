<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  public function grade()
  {
      return $this->belongsTo('App\Grade');
  }
  public function contents()
  {
      return $this->hasMany('App\Content');
  }
  public function activities()
  {
      return $this->hasMany('App\Activity');
  }
  public function posts()
  {
      return $this->hasMany('App\Post')->orderBy('created_at', 'desc');
  }
  public function topics()
  {
      return $this->hasMany('App\Topic');
  }
  public function replies()
    {
        return $this->hasManyThrough('App\Reply', 'App\Topic');
    }
}
