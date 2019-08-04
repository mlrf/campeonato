<?php

namespace App\models;

use App\Scopes\ClubScope;
use App\Transformers\ClubTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    //


    use SoftDeletes;

    public $transformer=ClubTransformer::class;

    protected $dates=['deleted_at'];

    protected $fillable=['name'];
    public $timestamps = false;




//    protected static function boot()
//    {
//        parent::boot(); // TODO: Change the autogenerated stub
//
//        static::addGlobalScope(new ClubScope());
//
//    }

    public function players(){
        return $this::hasMany('App\Models\Player');
    }
}
