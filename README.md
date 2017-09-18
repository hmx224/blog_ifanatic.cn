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



