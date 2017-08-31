<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Auth;
use Illuminate\Support\Facades\Request;

class QuestionFollowController extends Controller
{

    protected $question;


    public function __construct(QuestionRepository $question)
    {

        $this->middleware('auth');
        $this->question = $question;
    }

    //
    public function follow($question_id)
    {
        Auth::user()->followThis($question_id);

        return back();
    }

    public function follower(Request $request)
    {
        if (user('api')->followed($request->get('question'))) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    public function followThisQuestion(Request $request)
    {
        $question = $this->question->byId($request->get('question'));
        $followed = Auth::user()->followThis($question->id);
        if (count($followed['detached']) > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }
        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
