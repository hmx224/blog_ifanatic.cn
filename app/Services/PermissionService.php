<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/17
 * Time: 14:03
 */

namespace App\Services;


use App\Repositories\PermissionRepository;

class PermissionService
{
    public $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }


}