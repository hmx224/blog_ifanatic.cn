<?php

namespace App\Models;

use App\Mailer\UserMailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const  EMAIL_TYPE = [
        'qq' => 'qq.com',
        '126' => '126.com',
        '163' => '163.com',
        'sina' => 'sina.com',
        'hotmail' => 'hotmail.com',
        'gmail' => 'gmail.com',
    ];

    const EMAIL_TYPE_URL = [
        'qq' => 'https://mail.qq.com',
        '126' => 'http://mail.126.com',
        '163' => 'http://mail.163.com',
        'sina' => 'http://mail.sina.com.cn',
        'hotmail' => 'https://login.live.com',
        'gmail' => 'https://accounts.google.com',
    ];

    //用户激活状态 0未激活 1已激活
    const STATUS_NORMAL = 0;
    const STATUS_ACTIVE = 1;

    const DEFAULT_MANAGER = 1;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nick_name',
        'is_active',
        'email',
        'password',
        'avatar',
        'confirmation_token',
        'api_token',
        'setting',
        'remember_token',
        'source'
    ];

    const SOURCE_PHONE = 1;
    const SOURCE_SINA_WEIBO = 2;
    const SOURCE_WEIXIN = 3;
    const SOURCE_QQ = 4;
    const SOURCE_EMAIL = 5;
    const SOURCE_GITHUB = 6;

    const SOURCE = [
        1 => '手机号',
        2 => '新浪微博',
        3 => '微信',
        4 => 'QQ',
        5 => '邮箱',
        6 => 'GitHub'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sourceName()
    {
        return array_key_exists($this->source, static::SOURCE) ? static::SOURCE[$this->source] : '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @param string $token
     * 用户忘记密码邮件通知
     */
    public function sendPasswordResetNotification($token)
    {
        (new UserMailer())->passwordReset($token, $this->email);
    }

    /**
     * @param Model $model
     * @return bool
     * 判断问题的作者是否是登录的用户，进行编辑操作。
     */
    public function owns(Model $model)
    {
        return $model->user_id == $this->id;
    }

    //创建用户和问题的关联关系 TODO 存在问题
//    public function follows($question_id)
//    {
//        return UserQuestion::create([
//            'user_id' => $this->id,
//            'question_id' => $question_id
//        ]);
//    }

    //关联问题表，多对多关系
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class, 'user_question')->withTimestamps();
    }

    //存在就detach关联,不存在就attach删除关联

    /**
     * @param $question_id
     * @return array
     */
    public function followThis($question_id)
    {
        return $this->follows()->toggle($question_id);
    }

    /**
     * @param $question_id
     * @return bool
     */
    public function followed($question_id)
    {
        //强制返回布尔值

        return !!$this->follows()->where('question_id', $question_id)->count();
    }


    //用户之间的关联
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    //用户关注对应的关系
    public function followersUser()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    //关注此用户，取消关注此用户
    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }


    //点赞关联
    public function votes()
    {
        return $this->belongsToMany(Answer::class, 'votes')->withTimestamps();
    }

    //点赞的操作
    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }

    //是否已经点赞
    public function hasVotedFor($answer)
    {
        return !!$this->votes()->where('answer_id', $answer)->count();

    }

    //私信关系
    public function letters()
    {
        return $this->hasMany(Letter::class, 'to_user_id');
    }


}
