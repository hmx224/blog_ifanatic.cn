# blog_ifanatic.cn
一个讨论类型的网站，可以开放注册，发表问题，评论，回复等操作。

页面整体风格是bootstrap，使用了部分vue组件，配合laravel5.4作Api接口。

## 项目安装部署
### 1.git blog https://github.com/hmx224/blog_ifanatic.cn.git

### 2.需要将.env.example 文件改为 .env ,配置上数据库

### 3.composer install 将项目中用到的三方库下载

### 4.php artisan key:generate 生成唯一key,在.env文件中APP_KEY对应

### 5.php artisan migrate 生成数据库表

### 6.SERVER_ADMIN_EMAIL 设置用户发件人邮箱

### 7.设置sendCloud邮件服务的用户名和密码 
####  SEND_CLOUD_USER=

####  SEND_CLOUD_KEY=

### 8.配置七牛云上传信息
    1.在.env文件中追加
        QINIU_ACCESS_KEY=xxx
        QINIU_SECRET_KEY=xxx
        QINIU_BUCKET=xxx
        QINIU_DOMAIN=xxx(这里可以使用默认的)
    2.composer require "overtrue/laravel-filesystem-qiniu" -vvv 运行安大神的组件
    3.config/app.php中进行配置.
        'providers' => [
            // Other service providers...
            Overtrue\LaravelFilesystem\Qiniu\QiniuStorageServiceProvider::class,
        ],
    4.config/filesystems.php
        'providers' => [
            // Other service providers...
            Overtrue\LaravelFilesystem\Qiniu\QiniuStorageServiceProvider::class,
        ],
### 9.配置页面sql查询日志
    LOG_SAVE=true ,默认在env中不开启
### 10. 配置.env
    将APP_NAME=ifanatic.cn  改成爱狂热
### 11. 配置github
    GITHUB_CLIENT_ID=xxx(github key)
    GITHUB_CLIENT_SECRET=xxx(github秘钥)
    GITHUB_CLIENT_REDIRECT=xxx(网站回调地址)
##  12. 配置微博
    WEIBO_KEY=xxx
    WEIBO_CLIENT_SECRET=xxx
    WEIBO_REDIRECT_URI=xxx
##后台使用验证码
gregwar/captcha
##前端使用验证码
mews/captcha



