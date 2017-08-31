<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/7/11
 * Time: 15:03
 */

namespace App\Services\Api;


interface ApiService
{
    /**
     * @param $code
     * @return mixed
     */
    public function getError($code);

    /**
     * @param $code
     * @param null $data
     * @return mixed
     */
    public function run($code, $data = null);
}