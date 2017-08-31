<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/18
 * Time: 8:28
 */

namespace App\Services;


use App\Repositories\RoleUserRepository;

class RoleUserService
{
    public $repository;

    public function __construct(RoleUserRepository $repository)
    {
        $this->repository = $repository;
    }

}