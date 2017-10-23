<?php

namespace App\Http\Controllers;

use App\Repositories\LetterRepository;
use Auth;

class LettersController extends Controller
{
    //私信存储
    protected $letter;

    /**
     * LettersController constructor.
     * @param $letter
     */
    public function __construct(LetterRepository $letter)
    {
        $this->letter = $letter;
    }

    public function store()
    {
        $body = request('body');
        if (is_null($body)) {
            flash('请输入回复内容！', 'danger');
            return redirect()->to($this->getRedirectUrl())->withInput();
        }
        $letter = $this->letter->create([
            'to_user_id' => request('user'),
            'from_user_id' => user('api')->id,
            'body' => $body,
            'dialog_id' => time() . Auth::id()
        ]);

        if ($letter) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
