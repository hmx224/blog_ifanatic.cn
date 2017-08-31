<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/7/11
 * Time: 15:03
 */

namespace App\Services\Api;


class ApiServiceClass implements ApiService
{
    protected $error;

    /**
     * ApiServiceClass constructor.
     * @param Error $error
     */
    public function __construct(Error $error)
    {
        $this->error = $error;
    }

    /**
     * @param $code
     * @return string
     */
    public function getError($code)
    {

        return $this->error->getError($code);
    }

    /**
     * @param $code
     * @param null $data
     * @return mixed
     */
    public function run($code, $data = null)
    {

        is_null($data) ? $result =
            [
                'code' => $code,
                'msg' => $this->getError($code)
            ] :
            $result = [
                'code' => $code,
                'msg' => $this->getError($code),
                'data' => $data
            ];

        return response()->json($result);
    }

}