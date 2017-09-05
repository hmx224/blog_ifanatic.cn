<?php

return [
    '1' => [
        'jpush' => [
            'app_key' => '5891f2f9549ba634488f9a74',
            'master_secret' => '9376fda52b4dd8525800cb16',
        ],
        'watermark' => [
            'enabled' => true,
            'path' => 'images/watermark.png'
        ],
        'sms' => [
            'template' => [
                '0' => '找回密码验证码：找回密码手机验证码为@。【南宁头条】',
                '1' => '注册验证码：注册验证码为@【南宁头条】',
                '2' => '您在[南宁头条]系统中的密码已经重置为@，请尽快登录修改成自己的密码。【南宁头条】',
                '3' => '绑定手机验证码：绑定手机号验证码为@。【南宁头条】',
                '4' => '解除绑定手机验证码：解除绑定手机号验证码为@。【南宁头条】',
            ],
        ],
    ],

    'cdn' => [
        'image_url' => '',
        'video_url' => '',
        'static_url' => '',
    ],

    'upload' => [
        'url_prefix' => '',
        'avatar_path' => '/uploads/avatars',
        'video_path' => '/uploads/videos',
        'audio_path' => '/uploads/audios',
        'image_path' => '/uploads/images',
        'other_path' => '/uploads/others',
    ],
];