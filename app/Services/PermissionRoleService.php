<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/18
 * Time: 8:28
 */

namespace App\Services;


use App\Repositories\PermissionRoleRepository;

class PermissionRoleService
{
    public $repository;

    public function __construct(PermissionRoleRepository $repository)
    {
        $this->repository = $repository;
    }

}