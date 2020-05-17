<?php

namespace Shaxzodbek\ProductProperty\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Product;
use App\Property;
use App\ProductProperty;

class ProductPropertyController extends Controller
{
    /**
     * List the available related resources for a given resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$productId)
    {
        $categories = Product::find($productId)->categories()->pluck('id');
        $properties = Property::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id',$categories);
        })->with('values')->get();
        $product_properties = ProductProperty::where('product_id', $productId)->get();

        return response()->json([
            'properties' => $properties,
            'product_properties' => $product_properties    
        ]);
    }

    public function store(Request $request){
        $items = $request->all();
        foreach($items as $item){
            $product_property = ProductProperty::where('product_id',$item['product_id'])
                ->where('property_id',$item['property_id'])
                ->first();
            if ($item['property_value_id'] == 0){
                if ($product_property){
                    $product_property->delete();
                }
                continue;
            }
            if ($product_property){
                $product_property->update($item);
            }else{
                $productProperties = ProductProperty::create($item);
            }
        }
        return response()->json([
            'success' => true
        ]);
    }
}
