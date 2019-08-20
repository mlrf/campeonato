<?php

namespace App\Transformers;

use App\models\Player;
use League\Fractal\TransformerAbstract;

class PlayerTransformer extends TransformerAbstract
{
    /**
     * PlayerTransformer constructor.
     */
    public function __construct()

    {
        //parent::__construct(); // useful if the ApiController need to do something
        //$this->middleware('transform.input' . PlayerTransformer::class->only(['store','update']));

    }

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
            'deletedDate' => isset($player->deleted_at) ? $player->deleted_at : "never deleted",

            //hateoas

            'links' => [
                'rel' => 'self',
                'href' => route('players.show', $player->id),
            ],
//            [
//                'rel' => 'club.players',
//                'href' => route('club.players.index', $club->id),
//            ],

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
