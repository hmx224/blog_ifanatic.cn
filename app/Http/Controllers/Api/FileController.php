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

        $file_size = $file->getClientSize();

        $imageMaxSize = config('site.upload.imageMaxSize');

        if (empty($file_size)) {
            return Response::json([
                'code' => 404,
                'msg' => '上传失败',
            ]);
        }

        if ($file_size > $imageMaxSize) {
            return Response::json([
                'code' => 500,
                'msg' => '图片上传不能超过2M',
            ]);
        }

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $time = Carbon::now()->format('YmdHis');

        //使用Config就use Config,用法： Config::key()，这里用config

        $relativePath = config('site.upload.image_path') . '/' . $year . '/' . $month . $day . '/';

        $uploadPath = public_path() . $relativePath;

        $filename = $time . mt_rand(10000, 99999) . '.' . $extension;

        $targetFile = $uploadPath . $filename;

        if (request::get('type') == 'qiniu') {    //存储到七牛上
            $id = request::get('user_id');
            $filename = config('app.env') . '/avatars/' . $id . '/' . $filename;
            \Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(), 'r'));
            $url = 'http://' . config('filesystems.disks.qiniu.domain') . '/' . $filename;
        } else { //数据库
            $file->move($uploadPath, $targetFile);
            $url = config('site.upload.url_prefix') . $relativePath . $filename;
        }

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
