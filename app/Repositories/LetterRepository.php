<?php

namespace App\Repositories;

use App\Models\Letter;
use Auth;

/**
 * Class LetterRepository
 * @package App\Repositories
 */
class LetterRepository
{
    /**
     * @param array $attribute
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attribute)
    {
        return Letter::create($attribute);
    }


    /**
     * @param $id
     * @return mixed|static
     */
    public function byId($id)
    {
        return Letter::find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getAllLetters()
    {
        return Letter::with(['fromUser' => function ($query) {
            return $query->select(['id', 'name', 'avatar']);
        }, 'toUser' => function ($query) {
            return $query->select(['id', 'name', 'avatar']);
        }])
            ->where('to_user_id', Auth::id())
            ->orWhere('from_user_id', Auth::id())
            ->latest()
            ->get();
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     * 对话信息
     */
    public function getDialogLettersBy($dialogId)
    {
        return Letter::with(['fromUser' => function ($query) {
            return $query->select(['id', 'name', 'avatar']);
        }, 'toUser' => function ($query) {
            return $query->select(['id', 'name', 'avatar']);
        }])->where('dialog_id', $dialogId)
            ->latest()
            ->get();
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getSingleLettersBy($dialogId)
    {
        return Letter::where('dialog_id', $dialogId)->first();
    }

}