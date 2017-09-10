<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;
use Auth;

/**
 * Class AnswersController
 * @package App\Http\Controllers
 */
class AnswersController extends Controller
{

    /**
     * @var AnswerRepository
     */
    protected $answerRepository;

    /**
     * AnswersController constructor.
     * @param $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }


    /**
     * @param StoreAnswerRequest $request
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAnswerRequest $request, $question)
    {
        $answer = $this->answerRepository->create([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'body' => $request->get('body'),
        ]);

        //增加question对应的答案数
        $answer->question()->increment('answers_count');

        return back();
    }
}
