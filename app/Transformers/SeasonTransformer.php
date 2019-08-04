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
            'season' => $season->name,
        ];
    }
}
