<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  public function courses()
  {
      return $this->hasMany('App\Course')->orderBy('name');
  }
}
