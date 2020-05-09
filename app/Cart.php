<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'meta'];
    public function productsList()
    {
      return $this->belongsTo('App\Product', 'meta.products')
    }
}
