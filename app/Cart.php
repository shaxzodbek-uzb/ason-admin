<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'meta'];
    public function products()
    {
      return $this->belongsTo('App\Product', 'meta.products');
    }
}
