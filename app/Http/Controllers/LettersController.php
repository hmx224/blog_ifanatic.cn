<?php

namespace App\Http\Controllers;

use App\Repositories\LetterRepository;
use Auth;

class LettersController extends Controller
{
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
        $letter = $this->letter->create([
            'to_user_id' => request('user'),
            'from_user_id' => Auth::guard('api')->user()->id,
            'body' => request('body'),
        ]);

        if ($letter) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
