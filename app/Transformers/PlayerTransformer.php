<?php

namespace App\Transformers;

use App\models\Player;
use League\Fractal\TransformerAbstract;

class PlayerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Player $player)
    {
        return [
            'player' => $player->name,
            'shirt' => (string)$player->shirt_number,
            'injured' => (boolean)$player->is_injured,

        ];
    }
}
