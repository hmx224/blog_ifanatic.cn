<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Auth;

class VotesController extends Controller
{

    protected $answerRepository;

    /**
     * VotesController constructor.
     * @param $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    //判断是否点赞
    public function users($id)
    {
        $user = Auth::guard('api')->user();

        if ($user->hasVotedFor($id)) {
            return response()->json(['voted' => true]);
        }

        return response()->json(['voted' => false]);
    }

    //点赞操作.
    public function vote()
    {
        $answer = $this->answerRepository->byId(request('answer'));

        $voted = Auth::guard('api')->user()->voteFor($answer);

        if (count($voted['attached']) > 0) {

            $answer->increment('votes_count');

            return response()->json(['voted' => true]);
        }

        $answer->decrement('votes_count');

        return response()->json(['voted' => false]);
    }
}
