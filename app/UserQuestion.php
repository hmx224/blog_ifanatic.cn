<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// 用户关注问题

class UserQuestion extends Model
{
    protected $table = 'user_question';

    protected $fillable = [
        'user_id',
        'question_id'
    ];


}
