<?php

use Illuminate\Support\Facades\Route;

Route::get('product-properties/{productId}/list', 'ProductPropertyController@index');
Route::post('product-properties/{productId}/save', 'ProductPropertyController@store');