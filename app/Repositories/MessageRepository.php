<?php
/**
 * Created by PhpStorm.
 * User: zsgy
 * Date: 2017/8/14
 * Time: 15:04
 */


namespace App\Repositories;

use App\Model\Message;

/**
 * Class QuestionRepository
 * @package App\Repositories
 */
class MessageRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function byIdWithUser($id)
    {
        //一个留言关联用户
        return Message::where('id', $id)->with('user')->first();
    }

    public function count()
    {
        return Message::published()->get()->count();
    }

    /**
     * @param array $attribute
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attribute)
    {
        return Message::create($attribute);
    }


    public function byId($id)
    {
        return Message::find($id);
    }

    public function getMessageSeed()
    {
        $page = config('site.page_size');
        return Message::published()->latest('updated_at')->with('user')->paginate($page);
    }
}