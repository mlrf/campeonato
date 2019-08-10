<?php

namespace App\Repository;

use App\models\Player;
use Carbon\Carbon;

class Players
{
    CONST CACHE_KEY = 'PLAYERS';


    public function all($orderBy)
    {

        $key="all.{$orderBy}";
        $cacheKey=$this->getCacheKey($key);
        //dd($cacheKey);

        return cache()->remember($cacheKey,Carbon::now()->addMinutes(5),function() use($orderBy) {
            //when remember function cannot find the key
            return Player::orderBy($orderBy)->get();
        });

//        return Player::orderBy($orderBy)->get();
    }


    public function get($id)
    {
        $key="get.{$id}";

        $cacheKey=$this->getCacheKey($key);
//        dd($cacheKey);

        return cache()->remember($cacheKey,Carbon::now()->addMinutes(1),function() use($id){
            //when remember function cannot find the key
            return Player::findOrFail($id);
        });
    }

    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY . ".$key";
    }
}
