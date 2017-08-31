<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;
use Naux\Mail\SendCloudTemplate;


/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
        'email',
        'password',
        'avatar',
        'confirmation_token'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $data = ['url' => url('password/reset', $token)];

        $template = new SendCloudTemplate('ifanatic_app_password_reset', $data);

        Mail::raw($template, function ($message) {
            $message->from('3046526371@qq.com', 'ifanatic.cn');

            $message->to($this->email);
        });
    }

    //判断问题的作者是否是登录的用户，进行编辑操作。

    /**
     * @param Model $model
     * @return bool
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
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    public function followersUser()
    {
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }


}
