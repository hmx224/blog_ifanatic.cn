<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/13
 * Time: 15:15
 */

namespace App\Services;


use App\Repositories\PatientRepository;
use Illuminate\Support\Facades\Auth;

class PatientService
{
    public $repository;

    public function __construct(PatientRepository $repository, DoctorService $doctorService)
    {
        $this->repository = $repository;
        $this->doctorService = $doctorService;
    }

    /**
     * @param $name
     * @return int
     */
    public function getDoctorId($name){
        $data = $this->doctorService->repository->findWhere(['name' => $name])->toArray();
        if (empty($data)){
            return 0;
        }
        return $data[0]['id'];
    }


}