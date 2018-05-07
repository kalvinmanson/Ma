<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  public function content()
  {
    return $this->belongsTo('App\Content');
  }
}
