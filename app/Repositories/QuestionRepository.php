<?php
/**
 * Created by PhpStorm.
 * User: xiaohu
 * Date: 2017/8/14
 * Time: 15:04
 */


namespace App\Repositories;

use App\Models\Question;
use App\Models\Topic;
use App\Models\User;

/**
 * Class QuestionRepository
 * @package App\Repositories
 */
class QuestionRepository
{

    /**
     * @param $id
     * @return mixed
     */
    public function byIdWithTopicsAndAnswers($id)
    {
        //一个问题关联多个话题和多个答案
        return Question::where('id', $id)->with(['topics', 'answers', 'user'])->first();
    }

    //问题的总数
    public function questionsCount()
    {
        return Question::published()->get()->count();
    }


    //用户的总数
    public function usersCount()
    {
        return User::all()->count();
    }

    public function usersActive()
    {
        return User::orderBy('created_at', 'asc')
            ->where('is_active', User::STATUS_ACTIVE)
            ->get();
    }

    public function usersNotActive()
    {
        return User::orderBy('created_at', 'asc')
            ->where('is_active', User::STATUS_NORMAL)
            ->get();
    }


    /**
     * @param array $attribute
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attribute)
    {
        return Question::create($attribute);
    }


    /**
     * @param array $topics
     * @return array|\Illuminate\Support\Collection
     */
    public function normalizeTopic(array $topics)
    {
        $ids = Topic::pluck('id');

        $ids = collect($topics)->map(function ($topic) use ($ids) {
            if (is_numeric($topic) && $ids->contains($topic)) {
                return (int)$topic;
            }

            return Topic::firstOrCreate(['name' => $topic])->id;
        })->toArray();

        Topic::whereIn('id', $ids)->increment('questions_count');
        return $ids;
    }

    public function byId($id)
    {
        return Question::find($id);
    }

    public function getQuestionSeed()
    {
        //加上分页效果
        $page = config('site.page_size');
        return Question::published()->latest('updated_at')->with('user')->paginate($page);
    }

    public function getAllData($offset, $limit)
    {
        return Question::with('user')
            ->skip($offset)
            ->limit($limit)
            ->get();
    }
}