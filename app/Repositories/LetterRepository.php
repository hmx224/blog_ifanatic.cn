<?php

namespace App\Repositories;

use App\Models\Letter;

class LetterRepository
{
    public function create(array $attribute)
    {
        return Letter::create($attribute);
    }


    public function byId($id)
    {
        return Letter::find($id);
    }

}