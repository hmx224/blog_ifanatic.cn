<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/13
 * Time: 15:15
 */

namespace App\Services;


use App\Repositories\DeportmentRepository;

class DeportmentService
{

    public $repository;

    public function __construct(DeportmentRepository $repository)
    {
        $this->repository = $repository;
    }

}