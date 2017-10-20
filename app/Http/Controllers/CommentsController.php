<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Auth;

/**
 * Class CommentsController
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @var CommentRepository
     */
    protected $comment;
    /**
     * @var QuestionRepository
     */
    protected $question;
    /**
     * @var AnswerRepository
     */
    protected $answer;

    /**
     * CommentsController constructor.
     * @param $commentRepository
     */
    public function __construct(CommentRepository $comment, QuestionRepository $question, AnswerRepository $answer)
    {
        $this->comment = $comment;
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function question($id)
    {
        return $this->question->getQuestionCommentsById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function answer($id)
    {
        return $this->answer->getAnswerCommentsById($id);
    }

    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));

        return $this->comment->create([
            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => user('api')->id,
            'body' => request('body')
        ]);

    }

    /**
     * @param $type
     * @return string
     */
    public function getModelNameFromType($type)
    {
        return $type == 'question' ? 'App\Models\Question' : 'App\Models\Answer';
    }
}
