<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Hnassr\NovaKeyValue\KeyValue;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Shaxzodbek\ProductProperty\ProductProperty;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Product';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            
            new Tabs('Tabs', [
              'Main'    => [
                  ID::make()->sortable(),
                  Text::make('Title')
                    ->sortable()
                    ->rules('required', 'max:255')
                    ->autofill(),
                  Text::make('Cost')
                    ->rules('required', 'numeric')
                    ->autofill(),
                  Avatar::make('Cover image')->disk('public'),   
                  BelongsTo::make('Brand')->nullable(),
                  BelongsToMany::make('Categories'),     
                  Images::make('Gallary')
                      ->conversionOnIndexView('thumb')
                      ->hideFromIndex()
                      ->autofill(),
                  KeyValue::make('Features', 'meta')->hideFromIndex()
                  ->autofill(), 
                ],
                'Properties' => [
                  HasMany::make('Products'),
                  ProductProperty::make('Properties')->onlyOnDetail(),
                ],
          ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
