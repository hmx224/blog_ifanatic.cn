<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;
use Auth;

/**
 * Class QuestionsController
 * @package App\Http\Controllers
 */
class QuestionsController extends Controller
{

    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * QuestionsController constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $question = $this->questionRepository->byIdWithTopicsAndAnswers('5');
//        dd(Auth::user()->owns($question)==Auth::id());


        $questions = $this->questionRepository->getQuestionSeed();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeQuestionRequest $request)
    {

        $topics = $request->get('topics');

        if ($topics) {
            $topics = $this->questionRepository->normalizeTopic($topics);
        }

        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::user()->id,
        ];

        $question = $this->questionRepository->create($data);

        $question->topics()->attach($topics);

        return redirect()->route('question.show', compact('question'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //调用仓库中封装的方法展示问题

        $question = $this->questionRepository->byIdWithTopicsAndAnswers($id);

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);

        if (Auth::user()->owns($question)) {
            return view('questions.edit', compact('question'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        //
        $question = $this->questionRepository->byId($id);

        $topics = $request->get('topics');
        if ($topics) {
            $topics = $this->questionRepository->normalizeTopic($topics);
        }


        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        //sync 同步方法
        $question->topics()->sync($topics);

        return redirect()->route('question.show', compact('question'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $question = $this->questionRepository->byId($id);

        //判断该问题是否属于当前用户
        if (Auth::user()->owns($question)) {
            $question->delete();

            return redirect('/');

        }
        abort('403', 'Forbidden'); // return back();
    }


    /**
     * @param array $topics
     * TODO 不能过滤数字标签和相同的标签(数据库中已经有的。) 已经在questionRepository中重写
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic) {

            if (is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int)$topic;
            }

            $newTopic = Topic::create(['name' => $topic, 'questions_count' => 1]);

            return $newTopic->id;
        })->toArray();
    }
}
