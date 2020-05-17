<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    protected $fillable = ['product_id', 'property_id', 'property_value_id'];

}
