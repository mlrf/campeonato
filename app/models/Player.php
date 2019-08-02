<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{


    protected $fillable=['name'];

    public $timestamps = false;

    public function getClub(){
        return $this->belongsTo('App\models\Club');
    }
}
