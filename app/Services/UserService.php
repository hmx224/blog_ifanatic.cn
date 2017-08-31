<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/18
 * Time: 16:29
 */

namespace App\Services;


use App\Repositories\UserRepository;

class UserService
{
    public $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

}