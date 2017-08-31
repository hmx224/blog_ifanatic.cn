<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    //
    public function index(Request $request)
    {
        return Topic::select(['id', 'name'])
            ->where('name', 'like', '%' . $request->query('q') . '%')
            ->get();
    }


}
