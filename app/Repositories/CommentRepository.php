<?php


namespace App\Repositories;


use App\Models\Comment;

class CommentRepository
{
    public function create(array $attribute)
    {
        return Comment::create($attribute);
    }
}