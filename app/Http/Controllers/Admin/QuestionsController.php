<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;
use Request;
use Response;

class QuestionsController extends Controller
{

    protected $question;

    /**
     * QuestionsController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    public function index()
    {
        return view('admin.questions.index');
    }


    public function list()
    {
        $page = Request::get('page') ? Request::get('page') : 0;
        $limit = Request::get('limit') ? Request::get('limit') : 30;

        //前端传递的是page,第二页就让offset设置为0
        if ($page == 1) {
            $offset = 0;
        } else {
            $offset = $limit;
        }

        //返回列表接口
        $questions = $this->question->getAllData($offset, $limit);

        $total = $this->question->questionsCount();

        $questions->transform(function ($question) {
            $attributes = $question->getAttributes();
            foreach ($question->getDates() as $date) {
                $attributes[$date] = empty($question->$date) ? '' : $question->$date->toDateTimeString();
            }
            $attributes['user_name'] = $question->user->name;
            $attributes['created_at'] = empty($question->created_at) ? '' : $question->created_at->toDateTimeString();
            $attributes['updated_at'] = empty($question->updated_at) ? '' : $question->updated_at->toDateTimeString();
            return $attributes;
        });

        return Response::json([
            'code' => 0,
            'msg' => '返回数据',
            'count' => $total,
            'data' => $questions,
        ]);
    }
}
