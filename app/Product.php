<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
	use HasMediaTrait;
  public function registerMediaConversions(Media $media = null)
	{
	    $this->addMediaConversion('thumb')
	        ->width(130)
	        ->height(130);
	}

	public function registerMediaCollections()
	{
	    // $this->addMediaCollection('cover_image')->singleFile();
	    $this->addMediaCollection('gallary');
	}
}
