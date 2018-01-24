<?php
/**
 * Created by PhpStorm.
 * User: zsgy
 * Date: 2018/1/24
 * Time: 17:18
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Config;
use Request;
use Response;

class FileController extends BaseController
{
    const ALLOW_EXTENSIONS = ['gif', 'jpeg', 'jpg', 'png', 'webp', 'mp4', 'mpg', 'mpeg', 'avi', 'wav', 'mp3', 'amr', 'caf', 'pdf'];

    /**
     * @SWG\Post(
     *   path="/files/upload",
     *   summary="上传文件",
     *   tags={"/files 文件"},
     *   consumes={"multipart/form-data"},
     *   @SWG\Parameter(name="image_file", in="formData", required=false, description="图片文件", type="file"),
     *   @SWG\Parameter(name="video_file", in="formData", required=false, description="视频文件", type="file"),
     *   @SWG\Response(
     *     response=200,
     *     description="上传成功"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="没有找到"
     *   )
     * )
     */
    public function upload()
    {
        if (Request::hasFile('file')) {
            $file = Request::file('file');
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, static::ALLOW_EXTENSIONS)) {
                return $this->responseFail('不允许上传此类型文件');
            }

            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $day = Carbon::now()->format('d');
            $time = Carbon::now()->format('YmdHis');

            $relativePath = Config::get('site.upload.file_path') . '/' . $year . '/' . $month . $day . '/';
            $uploadPath = public_path() . $relativePath;
            $filename = $time . mt_rand(100, 999) . '.' . $extension;
            $targetFile = $uploadPath . $filename;

//            if (!file_exists($uploadPath)) {
//                mkdir(rtrim($uploadPath, '/'), 0777, true);
//                @exec('chmod -R 777 ' . rtrim($uploadPath, '/'));
//            }

            $file->move($uploadPath, $targetFile);

            $url = Config::get('site.upload.url_prefix') . $relativePath . $filename;

            return Response::json([
                'code' => 0,
                'msg' => 'success',
                'data' => get_url($url),
            ]);
        } else if (Request::hasFile('image_file')) {
            $file = Request::file('image_file');
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
            $filename = $time . mt_rand(100, 999) . '.' . $extension;
            $targetFile = $uploadPath . $filename;

            $file->move($uploadPath, $targetFile);

            $url = Config::get('site.upload.url_prefix') . $relativePath . $filename;


            return Response::json([
                'status_code' => 200,
                'message' => 'success',
                'data' => get_url($url),
            ]);
        }
    }
}