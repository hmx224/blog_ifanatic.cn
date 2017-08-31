<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'comments_count',
        'followers_count',
        'answers_count',
        'close_count',
        'is_hidden'
    ];


    public function isHidden()
    {
        return $this->is_hidden === 'T';
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_hidden', 'F');
    }
}
