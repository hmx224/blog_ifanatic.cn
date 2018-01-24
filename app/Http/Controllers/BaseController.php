<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Response;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     basePath="/api",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="CMS API v1",
 *         termsOfService="",
 *     ),
 * )
 */
class BaseController extends Controller
{
    protected $status_code = 200;
    protected $message = 'success';

    public function __construct()
    {
        header("Cache-Control:no-cache");
    }

    /**
     * 返回自定义数据
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data)
    {
        return Response::json($data);
    }

    /**
     * 成功并返回数据
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($data = [])
    {
        return $this->response([
            'code' => 200,
            'msg' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * 错误并返回错误信息和状态码
     *
     * @param $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($message, $status_code = 404)
    {
        \Log::debug('Error IP: ' . get_client_ip() . ', ' . $message);
        return $this->response([
            'code' => $status_code,
            'msg' => $message,
        ]);
    }

    /**
     * 错误并返回失败信息和状态码
     *
     * @param $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseFail($message, $status_code = 404)
    {
        return Response::json([
            'code' => $status_code,
            'msg' => $message,
        ], $status_code);
    }
}