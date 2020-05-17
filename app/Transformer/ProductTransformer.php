<?php
namespace App\Transformer;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['gallery'];

    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'title' => $product->title,
            'cover_image' => $product->cover_image,
            'cost' => $product->cost,
            'meta' => json_decode($product->meta, true),
        ];
    }
    public function includeGallery(Product $product)
    {
      return $this->collection($product->getMedia('gallary'), new MediaTransformer);
    }
}