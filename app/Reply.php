<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  public function user()
  {
      return $this->belongsTo('App\User');
  }
  public function topic()
  {
      return $this->belongsTo('App\Topic');
  }
  public function votes()
  {
      return $this->hasMany('App\Vote');
  }
}
