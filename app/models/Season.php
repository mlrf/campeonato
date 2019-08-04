<?php

namespace App\models;

use App\Transformers\SeasonTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{

    use SoftDeletes;


    public $transformer=SeasonTransformer::class;

    protected $fillable=['name'];
}
