<?php

namespace App\Services;

use App\Repositories\UserRepository;

/**
 */
class UserService
{
    /**
     * Main repository.
     */
    public function __construct()
    {
        $this->userRepository = app()->make(UserRepository::class);
    }

    /**
     * test
     */
    public function test(){
    }

}
