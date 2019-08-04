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
            'shirt' => $player->shirt_number,
            'injured' => $player->is_injured,
            'deleted date' => isset($player->deleted_at) ? $player->deleted_at : "never deleted"


        ];
    }
}
