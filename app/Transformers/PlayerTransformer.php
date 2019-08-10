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
            'identifier'=>$player->id,
            'player' => $player->name,
            'shirt' => $player->shirt_number,
            'injured' => $player->is_injured,
            'deletedDate' => isset($player->deleted_at) ? $player->deleted_at : "never deleted"
        ];


    }

    public static function originalAttributes($index){
        $attributes=[
            'identifier' =>'id',
            'player' => 'name',
            'shirt' => 'shirt_number',
            'injured' => 'is_injured',
            'deletedDate' => 'deleted_at'
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
