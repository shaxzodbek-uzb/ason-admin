<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
  use NodeTrait;

  public function parent(){
    return $this->belongsTo('App\Category','parent_id');
  }
  public function children(){
    return $this->hasMany('App\Category','parent_id');
  }
  public function getLftName()
  {
      return 'left';
  }
  
  public function getRgtName()
  {
      return 'right';
  }
  
  public function getParentIdName()
  {
      return 'parent_id';
  }
  public function products()
  {
    return $this->belongsToMany('App\Product');
  }
}
