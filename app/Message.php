<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    const DISABLED = "T"; //关闭
    const ENABLED = "F";  //启用

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
