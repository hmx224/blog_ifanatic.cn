<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/13
 * Time: 15:14
 */

namespace App\Services;


use App\Repositories\ZoneRepository;

class ZoneService
{
    public $repository;

    public function __construct(ZoneRepository $repository)
    {
        $this->repository = $repository;
    }

}