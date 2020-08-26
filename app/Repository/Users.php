<?php

namespace App\Repository;

class Users {

    CONST CACHE_KEY = 'users';

    public function all($orderBy)
    {   

        $cacheKey = $this->getCacheKey();
        $users = cache()->remember($cacheKey, \Carbon\Carbon::now()->addMinutes(5), function () use($orderBy){
            return \App\User::orderBy($orderBy)->get();
        });

        return $users;

    }

    public function getCacheKey()
    {
        return self::CACHE_KEY;
    }

}