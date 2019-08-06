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
        ];
    }

    public static function originalAttributes($index){
        $attributes=[
            'identifier'=>'id',
            'season' => 'name',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
