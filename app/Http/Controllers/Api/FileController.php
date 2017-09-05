<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Config;
use Request;
use Response;

//TODO 接口可用，前端需要修改
class FileController extends BaseController
{
    const ALLOW_EXTENSIONS = ['gif', 'jpeg', 'jpg', 'png', 'mp4', 'mpg', 'mpeg', 'avi', 'wav', 'mp3', 'amr', 'caf'];

    //文件上传使用
    public function upload()
    {
        $file = Request::file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, static::ALLOW_EXTENSIONS)) {
            return $this->responseFail('不允许上传此类型文件');
        }

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $time = Carbon::now()->format('YmdHis');

        $relativePath = Config::get('site.upload.image_path') . '/' . $year . '/' . $month . $day . '/';
        $uploadPath = public_path() . $relativePath;
        $filename = $time . mt_rand(10000, 99999) . '.' . $extension;
        $targetFile = $uploadPath . $filename;

        $file->move($uploadPath, $targetFile);

        $url = Config::get('site.upload.url_prefix') . $relativePath . $filename;

        //layui返回格式
        return Response::json([
            'code' => 0,
            'msg' => '图片上传成功',
            'data' => [
                'src' =>get_url($url),
                'title'=>''
            ]
        ]);
    }
}
