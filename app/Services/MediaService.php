<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/8/13
 * Time: 15:14
 */

namespace App\Services;


use App\Repositories\MediaRepository;

class MediaService
{
    public $repository;

    public function __construct(MediaRepository $repository)
    {
        $this->repository = $repository;
    }

}