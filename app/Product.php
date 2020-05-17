<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    protected static function boot()
    {
        parent::boot();
    }
  protected $fillable=["title",'cover_image','cost','meta','brand_id'];
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
  public function brand()
  {
    return $this->belongsTo('App\Brand');
  }
  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }
  public function products()
  {
    return $this->hasMany('App\Product','parent_id', 'id');
  }
  public function parent(){
      return $this->belongsTo('App\Product', 'parent_id', 'id');
  }
  public function properties()
  {
    return $this->hasMany('App\ProductProperty');
  }
}
