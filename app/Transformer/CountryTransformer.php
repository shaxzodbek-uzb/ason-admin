<?php
namespace App\Transformer;

use App\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
    public function transform(Country $country)
    {
        return [
            'id' => $country->id,
            'name' => $country->name
        ];
    }
}