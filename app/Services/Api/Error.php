<?php
/**
 * Created by PhpStorm.
 * User: Blue
 * Date: 2017/7/11
 * Time: 15:55
 */

namespace App\Services\Api;


class Error
{
    /**
     * 错误码
     * */
    public static $errCodes = [
        // 系统码
        '200' => '成功',
        '400' => '未知错误',
        '401' => '无此权限',
        '500' => '服务器异常',
        // 公共错误码
        '1001' => '缺失',
        '1002' => '不存在或无权限',
        '1003' => '[method]缺失',
        '1004' => '[format]错误',
        '1005' => '[sign_method]错误',
        '1006' => '[sign]缺失',
        '1007' => '[sign]签名错误',
        '1008' => '[method]方法不存在',
        '1009' => 'run方法不存在，请联系管理员',
        '1010' => '[model]缺失',
        '1011' => '[nonce]必须为字符串',
        '1012' => '[nonce]长度必须为1-32位',
    ];


    /**
     * 返回错误码
     * @param string $status
     * @param bool $_
     * @return string
     */
    public static function getError($code = '400', $_ = false)
    {

        if (! isset(self::$errCodes[$code])) {
            $code = '400';
        }
        return ($_ ? "[{$code}]" : '')
            . self::$errCodes[$code];
    }

}