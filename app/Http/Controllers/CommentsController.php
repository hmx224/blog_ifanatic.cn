<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function answer($id)
    {
        //加上分页效果
        $page = config('site.page_size');
        $answer = Answer::with('comments', 'comments.user')->where('id', $id)->first();
        return $answer->comments;
    }

    public function question($id)
    {
        //加上分页效果
        $page = config('site.page_size');
        $question = Question::with('comments', 'comments.user')->where('id', $id)->first();
        return $question->comments->paginate($page);
    }

    public function getModelNameFromType($type)
    {
        return $type == 'question' ? 'App\Models\Question' : 'App\Models\Answer';
    }

    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));

        $comment = Comment::create([

            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => Auth::guard('api')->user()->id,
            'body' => request('body')

        ]);

        return $comment;

    }


}
