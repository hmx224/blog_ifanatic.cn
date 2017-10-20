<?php
/**
 * Created by PhpStorm.
 * User: zsgy
 * Date: 2017/8/14
 * Time: 15:04
 */


namespace App\Repositories;

use App\Models\Answer;

/**
 * Class AnswerRepository
 * @package App\Repositories
 */
class AnswerRepository
{

    public function create(array $attribute)
    {
        return Answer::create($attribute);
    }

    public function byId($id)
    {
        return Answer::find($id);
    }
}