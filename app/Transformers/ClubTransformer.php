<?php

namespace App\Transformers;

use App\models\Club;
use League\Fractal\TransformerAbstract;

class ClubTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Club $club)
    {
        return [
            'identifier'=>(string) $club->id,
            'club' => (string)$club->name,
            'address' => (string)$club->address,
            'fiscalNumber' => (string)$club->vat,
            'deletedDate' => isset($club->deleted_at) ? (string)$club->deleted_at : null,

        ];
    }

    public static function originalAttributes($index){
        $attributes=[
            'club' => 'name',
            'address' => 'address',
            'fiscalNumber' => 'vat',
            'deletedDate' => 'deleted_at'
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
