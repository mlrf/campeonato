<?php

namespace App\Transformers;

use App\models\Season;
use League\Fractal\TransformerAbstract;

class SeasonTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Season $season)
    {
        return [
            'identifier'=> $season->id,
            'season' => $season->name,

            //hateoas
            'links' => [
                'rel' => 'self',
                'href' => route('seasons.show', $season->id),
            ],
        ];
    }

    public static function originalAttributes($index){
        $attributes=[
            'identifier'=>'id',
            'season' => 'name',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttributes($index){
        $attributes=[
            'id'=>'identifier',
            'name' => 'season',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
