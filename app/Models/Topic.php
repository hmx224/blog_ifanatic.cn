<?php

namespace App\Models;

use App\BaseModel;

class Topic extends BaseModel
{
    protected $table = 'topics';

    protected $fillable = [
        'name',
        'bio',
        'questions_count',
        'followers_count'
    ];

    public function questions()
    {
        //操作created_at和updated_at字段

        return $this->belongsToMany(Question::class)->withTimestamps();

    }
}
