<?php
namespace App\Transformer;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'title' => $product->title,
            'cover_image' => $product->cover_image,
            'cost' => $product->cost
        ];
    }
}