<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

  public function values()
  {
    return $this->hasMany('App\PropertyValue');
  }
  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }
}
