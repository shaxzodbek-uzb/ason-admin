<?php
namespace App\Transformer;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['children', 'parent', 'products'];
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'order' => $category->order,
        ];
    }
    public function includeParent(Category $category){
      $parent = $category->parent;
      if ($parent)
        return $this->item($parent, new CategoryTransformer);
    }
    
    public function includeChildren(Category $category){
      $children = $category->children;
      if ($children)
        return $this->collection($children, new CategoryTransformer);
    }
    public function includeProducts(Category $category)
    {
      if ($category->products)
        return $this->collection($category->products, new ProductTransformer);
    }
}