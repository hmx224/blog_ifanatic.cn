<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
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

        return $this->belonsToMany(Topic::class)->withTimestamps();

    }
}
