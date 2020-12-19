<?php
namespace App\Services;

use App\User;
use App\Exceptions\UserNotFoundException;

class UserService
{

    public function search($user_id)
    {
        $user = User::find($user_id);
        if($user == null){
            throw new UserNotFoundException('User not found by ID ' . $user_id);
        }
        return $user;
    }

}