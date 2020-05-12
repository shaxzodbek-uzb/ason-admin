<?php
namespace App\Transformer;

use App\Vacancy;
use League\Fractal\TransformerAbstract;

class VacancyTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    public function transform(Vacancy $vacancy)
    {
        return [
            'id' => $vacancy->id,
            'name' => $vacancy->name,
            'description' => $vacancy->description,
            'cover_image' => $vacancy->cover_image
        ];
    }
}