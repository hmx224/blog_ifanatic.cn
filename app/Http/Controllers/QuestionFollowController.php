<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Auth;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    protected $question;

    public function __construct(QuestionRepository $question)
    {
        $this->middleware('auth');
        $this->question = $question;
    }

    //用户关注问题
    public function follow($question_id)
    {
        Auth::user()->followThis($question_id);

        return back();
    }
    //问题是否被关注
    public function follower(Request $request)
    {
        if (user('api')->followed($request->get('question'))) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }
    //关注问题
    public function followThisQuestion(Request $request)
    {
//        $user = Auth::guard('api')->user();

        $question = $this->question->byId($request->get('question'));

        $followed = user('api')->followThis($question->id);
        
        //取消关注 attached 可以取到用户关注的问题id
        if (count($followed['detached']) > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }

        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
