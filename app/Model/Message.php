<?php

namespace App\Model;

use App\BaseModel;

class Message extends BaseModel
{
    protected $table = 'messages';



    protected $fillable = [
        'user_id',
        'manager_id',
        'title',
        'content',
        'type',
        'status',
        'likes_count',
        'comments_count',
        'is_disabled'
    ];

    public function isDisabled()
    {
        return $this->is_disabled === 'T';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //留言启用状态
    public function scopePublished($query)
    {
        return $query->where('is_disabled', 'F');
    }
}
