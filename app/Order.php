<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'email',
        'status',
        'country_id',
        'products',
        'delivery_info',
        'overal',
        'meta',
    ];
}
