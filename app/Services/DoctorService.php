<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/13
 * Time: 15:13
 */

namespace App\Services;


use App\Repositories\DoctorRepository;

class DoctorService
{
    public $repository;

    public function __construct(DoctorRepository $repository)
    {
        $this->repository = $repository;
    }

}