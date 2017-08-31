<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/18
 * Time: 8:27
 */

namespace App\Services;


use App\Repositories\PermissionUserRepository;

class PermissionUserService
{
    public $repository;

    public function __construct(PermissionUserRepository $repository)
    {
        $this->repository = $repository;
    }

}