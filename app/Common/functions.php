<?php

/**
 * 产生随机字符串
 *
 * @param    int $length 输出长度
 * @param    string $chars 可选的 ，默认为 0123456789
 * @return   string     字符串
 */
function random($length, $chars = '0123456789')
{
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 获取完整URL
 *
 * @param $url
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function get_url($url)
{
    if (empty($url)) {
        return '';
    } else {
        return url($url);
    }
}

/**
 * 获取图片URL
 *
 * @param $url
 * @return string
 */
function get_image_url($url)
{
    if (empty($url)) {
        return '';
    } elseif (substr_compare(strtolower($url), 'http', 0, 4) == 0) {
        return $url;
    } else {
        return config('site.cdn.image_url') . $url;
    }
}

/**
 * 获取视频URL
 *
 * @param $url
 * @return string
 */
function get_video_url($url)
{
    if (empty($url)) {
        return '';
    } elseif (substr_compare(strtolower($url), 'http', 0, 4) == 0) {
        return $url;
    } else {
        return config('site.cdn.video_url') . $url;
    }
}

/**
 * 获取静态文件URL
 *
 * @param $url
 * @return string
 */
function get_static_url($url)
{
    if (empty($url)) {
        return '';
    } elseif (substr_compare(strtolower($url), 'http', 0, 4) == 0) {
        return $url;
    } else {
        return config('site.cdn.static_url') . $url;
    }
}

/**
 * 替换内容中的图片URL
 *
 * @param $content
 * @return mixed
 */
function replace_content_url($content)
{
    return str_replace('"/uploads/images', '"' . config('site.cdn.image_url') . '/uploads/images', $content);
}

/**
 * HTTP GET
 *
 * @param $url
 * @param array $opts
 * @return string
 */
function curl_get($url, $opts = [])
{
    //初始化
    $ch = curl_init();

    //设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    foreach ($opts as $k => $opt) {
        curl_setopt($ch, $k, $opt);
    }

    //执行并获取内容
    $result = curl_exec($ch);

    if (!$result) {
        var_dump(curl_error($ch));
    }

    //释放curl句柄
    curl_close($ch);

    return $result;
}

/**
 * HTTP POST
 *
 * @param $url
 * @param $data
 * @return string
 */
function curl_post($url, $data)
{
    //初始化
    $ch = curl_init();

    //设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    //执行并获取内容
    $result = curl_exec($ch);

    //释放curl句柄
    curl_close($ch);

    return $result;
}

/**
 * 随机字符串
 *
 * @param int $len
 * @return string
 */
function str_rand($len = 6)
{
    $chars = 'abdefghijklmnopqrstuvwxyz0123456789';
    mt_srand((double)microtime() * 1000000 * getmypid());
    $password = '';
    while (strlen($password) < $len)
        $password .= substr($chars, (mt_rand() % strlen($chars)), 1);
    return $password;
}

/**
 * 从缓存或回调函数中获取值（正式环境）
 * 从回调函数中获取值（开发环境）
 *
 * @param $key
 * @param $minutes
 * @param $callback
 * @return mixed
 */
function cache_remember($key, $minutes, $callback)
{
    if (env('APP_DEBUG')) {
        return call_user_func($callback);
    } else {
        return Cache::remember($key, $minutes, $callback);
    }
}

/**
 * 短时间显示, 几秒前, 几分钟前...
 *
 * @param $time
 * @return string
 */
function time_trans($time)
{
    $t = time() - $time;
    $f = array(
        '31536000' => '年',
        '2592000' => '个月',
        '604800' => '星期',
        '86400' => '天',
        '3600' => '小时',
        '60' => '分钟',
        '1' => '秒'
    );
    foreach ($f as $k => $v) {
        if (0 != $c = floor($t / (int)$k)) {
            return $c . $v . '前';
        }
    }
}

/**
 * 获取客户端真实IP
 *
 * @return string
 */
function get_client_ip()
{
    return isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : Request::getClientIp();
}

/**
 * 数组转对象
 *
 * @param $array
 * @return StdClass
 */
function array_to_object($array)
{
    if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
    } else {
        $obj = $array;
    }
    return $obj;
}

/**
 * 对象转数组
 *
 * @param $object
 * @return mixed
 */
function object_to_array($object)
{
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    } else {
        $array = $object;
    }
    return $array;
}

/**
 * 字符串数组转选项
 *
 * @param $array
 * @return array
 */
function array_to_option($array)
{
    if (is_array($array)) {
        foreach ($array as $key => $val) {
            $array[$val] = $val;
            unset($array[$key]);
        }
    }

    return $array;
}

/**
 * 字符串(逗号分隔)转选项
 *
 * @param $string
 * @return array
 */
function string_to_option($string)
{
    $array = explode(',', $string);

    return array_to_option($array);
}

/**
 * 判断当前访问的用户是PC端，还是手机端，返回true为手机端，false为PC端
 * @return boolean
 */
function is_mobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;

    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])) {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            return true;
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

/**
 * 获取主题资源路径
 *
 * @param $path
 * @return string
 */
function theme_asset_path($path)
{
    return public_path('themes' . DIRECTORY_SEPARATOR . $path);
}

/**
 * 获取主题试图路径
 *
 * @param $path
 * @return string
 */
function theme_view_path($path)
{
    return resource_path('views/themes' . DIRECTORY_SEPARATOR . $path);
}