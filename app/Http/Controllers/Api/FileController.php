<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
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

        \Log::info('自定义image_path之前1', [config('site.upload.image_path')]);
        \Log::info('自定义image_path之前2', [config('site["upload"]["image_path"]')]);

        //使用Config就use Config,用法： Config::key()，这里用config
        $image_path = '/uploads/images';

        $relativePath = config('site.upload.image_path', $image_path) . '/' . $year . '/' . $month . $day . '/';

        $uploadPath = public_path() . $relativePath;

        $filename = $time . mt_rand(10000, 99999) . '.' . $extension;

        $targetFile = $uploadPath . $filename;

        $file->move($uploadPath, $targetFile);

        $url = config('site.upload.url_prefix') . $relativePath . $filename;

        \Log::info('url_prefix', [config('site.upload.url_prefix')]);
        \Log::info('自定义image_path之后', [config('site.upload.image_path')]);

        //layui返回格式
        return Response::json([
            'code' => 0,
            'msg' => '图片上传成功',
            'data' => [
                'src' => get_url($url),
                'title' => ''
            ]
        ]);
    }

    /**
     * @param $path '创建的路径'
     * @param $mode '文件夹的权限'
     * @return mixed '允许多层目录'
     */
    public static function createDirList($path, $mode)
    {
        if (is_dir($path)) {
            return $path;
        } else {
            $re = mkdir($path, $mode, true);
            chmod($path, $mode);
            if (!$re) {
                exit('发生未知错误,请稍后重试!');
            }
            return $path;
        }
    }
}
