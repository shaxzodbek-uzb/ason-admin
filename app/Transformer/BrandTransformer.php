<?php
namespace App\Transformer;

use App\Brand;
use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['products'];
    // protected $defaultIncludes = ['products'];
    public function transform(Brand $brand)
    {
      
      return [
            'id' => $brand->id,
            'name' => $brand->name,
            'description' => $brand->description,
            'cover_image' => $brand->cover_image
        ];
    }
    public function includeProducts(Brand $brand)
    {
      return $this->collection($brand->products, new ProductTransformer);
    }
}