<?php
/**
 * Created by PhpStorm.
 * User: zsgy
 * Date: 2017/8/14
 * Time: 15:04
 */


namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{

    public function byId($id)
    {
        return User::find($id);
    }


    public function create(array $attribute)
    {
        return User::create($attribute);
    }

    public function getUserInfoBy($name)
    {
        return User::where('name', $name)->first();
    }


}