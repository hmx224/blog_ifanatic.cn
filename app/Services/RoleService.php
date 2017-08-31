<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/17
 * Time: 14:00
 */

namespace App\Services;


use App\Repositories\RoleRepository;

class RoleService
{
    public $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

}