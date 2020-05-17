<?php

namespace App\Observers;

use App\Product;
use App\ProductProperty;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        // todo categories - ok
        // todo cover_image
        // todo gallery
        // todo properties - ok
        if ($product->parent_id){
            $categories = $product->parent->categories()->pluck('id');
            $product->categories()->attach($categories);
            $product_properties = ProductProperty::where('product_id', $product->parent_id)->get();
            foreach($product_properties as $item){
                ProductProperty::create([
                    'product_id' => $product->id,
                    'property_id' => $item->property_id,
                    'property_value_id' => $item->property_value_id
                ]);
            }
            if ($product->cover_image == Null){
                $product->cover_image = $product->parent->cover_image;
            }
            if ($product->brand_id == Null){
                $product->brand_id = $product->parent->brand_id;
            }
            $product->update();
        }
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
