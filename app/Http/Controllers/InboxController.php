<?php

namespace App\Http\Controllers;

use App\Repositories\LetterRepository;
use Auth;

class InboxController extends Controller
{
    //消息通知

    protected $letter;

    /**
     * InboxController constructor.
     */
    public function __construct(LetterRepository $letter)
    {
        $this->middleware('auth');
        $this->letter = $letter;
    }

    public function index()
    {
        $letters = $this->letter->getAllLetters();
//        return $letters->groupBy('dialog_id');
        return view('inbox.index', ['letters' => $letters->groupBy('dialog_id')]);

    }

    //letter list of each other
    public function show($dialogId)
    {
        $letters = $this->letter->getDialogLettersBy($dialogId);

        $letters->markAsRead();

        return view('inbox.show', compact('letters', 'dialogId'));
    }

    public function store($dialogId)
    {
        $letter = $this->letter->getSingleLettersBy($dialogId);

        $toUserId = $letter->from_user_id === Auth::id() ? $letter->to_user_id : $letter->from_user_id;

        $this->letter->create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $toUserId,
            'body' => request('body'),
            'dialog_id' => $dialogId
        ]);

        return back();
    }
}
