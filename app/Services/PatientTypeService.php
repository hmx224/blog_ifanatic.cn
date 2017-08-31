<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/13
 * Time: 15:14
 */

namespace App\Services;


use App\Repositories\PatientTypeRepository;

class PatientTypeService
{

    public $repository;

    /**
     * PatientTypeService constructor.
     * @param PatientTypeRepository $repository
     */
    public function __construct(PatientTypeRepository $repository)
    {
        $this->repository = $repository;
    }

}