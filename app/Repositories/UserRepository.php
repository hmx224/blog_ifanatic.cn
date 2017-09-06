<?php
/**
 * Created by PhpStorm.
 * User: zsgy
 * Date: 2017/8/14
 * Time: 15:04
 */


namespace App\Repositories;

use App\Model\User;

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
}