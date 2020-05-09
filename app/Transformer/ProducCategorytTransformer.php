<?php
namespace App\Transformer;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductCategoryTransformer extends TransformerAbstract
{
    protected $includes = ['children', 'parent'];
    public function transform(ProductCategory $productCategory)
    {
        return [
            'id' => $productCategory->id,
            'title' => $productCategory->title,
            'slug' => $productCategory->slug,
            'order' => $productCategory->order,
        ];
    }
    public function includeParent(ProductCategory $productCategory){
      $parent = $productCategory->parent;
      if ($parent)
        return $this->item($parent, new ProductCategoryTransformer);
    }
    
    public function includeChildren(ProductCategory $productCategory){
      $children = $productCategory->children;
      if ($children)
        return $this->collection($children, new ProductCategoryTransformer);
    }
}