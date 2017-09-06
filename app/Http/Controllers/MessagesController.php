<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Model\Message;
use App\Model\User;
use App\Repositories\MessageRepository;
use Auth;

class MessagesController extends Controller
{
    protected $message;

    /**
     * MessagesController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    //留言板操作
    public function index()
    {
        $messages = $this->message->getMessageSeed();

        $count = $this->message->count();

        return view('messages.index', compact('messages', 'count'));
    }

    //展示发表留言页面
    public function create()
    {
        return view('messages.create');
    }

    //入库留言信息
    public function store(MessageRequest $request)
    {
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::user()->id,
            'manager_id' => User::DEFAULT_MANAGER
        ];

        $message = $this->message->create($data);

        return redirect()->route('messages.show', compact('message'));
    }

    //展示页面
    public function show($id)
    {
        $message = $this->message->byIdWithUser($id);
        return view('messages.show', compact('message'));
    }

    public function edit($id)
    {
        $message = $this->message->byId($id);

        if (Auth::user()->owns($message)) {
            return view('messages.edit', compact('message'));
        }

        return back();
    }

    public function update(MessageRequest $request, $id)
    {
        $message = $this->message->byId($id);

        $message->update([
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]);

        return redirect()->route('messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = $this->message->byId($id);

        //判断该问题是否属于当前用户
        if (Auth::user()->owns($message)) {

            $message->is_hidden = Message::DISABLED;
            $message->save();

            return redirect('messages');

        }
        abort('403', 'Forbidden'); // return back();
    }


}
