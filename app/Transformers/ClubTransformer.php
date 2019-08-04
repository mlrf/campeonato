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
            'club' => (string)$club->name,
            'address' => (string)$club->address,
            'fiscalNumber' => (string)$club->vat,
            'deletedDate' => isset($club->deleted_at) ? (string)$club->deleted_at : null,

        ];
    }
}
