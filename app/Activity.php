<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  public function course()
  {
      return $this->belongsTo('App\Course');
  }
  public function content()
  {
      return $this->belongsTo('App\Content');
  }
}
