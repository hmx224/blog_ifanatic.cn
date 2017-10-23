<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Auth;

class LetterCollection extends Collection
{
    //循环执行markAsRead方法
    public function markAsRead()
    {
        $this->each(function($letter){
            if ($letter->to_user_id === Auth::id()){
                $letter->markAsRead();
            }
        });
    }

}
