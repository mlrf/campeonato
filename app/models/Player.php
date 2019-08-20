<?php

namespace App\models;

use App\Transformers\PlayerTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{

    use SoftDeletes;

    public $transformer=PlayerTransformer::class;

    protected $fillable=['name,shirt_number,is_injured'];

    public $timestamps = false;

    public function club(){
        return $this->belongsTo('App\models\Club');
    }
}
