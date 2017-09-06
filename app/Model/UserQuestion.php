<?php

namespace App\Model;

use App\BaseModel;

// 用户关注问题

class UserQuestion extends BaseModel
{
    protected $table = 'user_question';

    protected $fillable = [
        'user_id',
        'question_id'
    ];


}
