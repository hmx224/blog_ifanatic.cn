<?php

namespace App\Models;

use App\BaseModel;

class Answer extends BaseModel
{
    protected $table = 'answers';

    protected $fillable = [
        'user_id',
        'question_id',
        'body',
        'votes_count',
        'comments_count',
        'is_hidden',
        'close_comment'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

