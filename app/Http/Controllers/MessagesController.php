<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Model\Message;
use App\Model\User;
use App\Repositories\MessageRepository;
use Auth;

class MessagesController extends Controller
{
    protected $messageRepository;

    /**
     * MessagesController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    //留言板操作
    public function index()
    {
//        dd(bcrypt('123456'));
        $messages = $this->messageRepository->getMessageSeed();

        $count = $this->messageRepository->count();

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

        $message = $this->messageRepository->create($data);

        flash('留言成功！', 'success');
        return redirect()->route('messages.show', compact('message'));
    }

    //展示页面
    public function show($id)
    {
        $message = $this->messageRepository->byIdWithUser($id);
        return view('messages.show', compact('message'));
    }

    public function edit($id)
    {
        $message = $this->messageRepository->byId($id);

        if (Auth::user()->owns($message)) {
            return view('messages.edit', compact('message'));
        }

        return back();
    }

    public function update(MessageRequest $request, $id)
    {
        $message = $this->messageRepository->byId($id);

        $message->update([
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]);
        flash('修改成功！', 'success');
        return redirect()->route('messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = $this->messageRepository->byId($id);

        //判断该问题是否属于当前用户
        if (Auth::user()->owns($message)) {

            $message->is_hidden = Message::DISABLED;
            $message->save();

            return redirect('messages');

        }
        flash('删除成功！', 'success');

        abort('403', 'Forbidden'); // return back();
    }


}
