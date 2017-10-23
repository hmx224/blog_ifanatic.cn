<?php


namespace App\Repositories;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicRepository
{
    public function getTopicForTagging(Request $request)
    {
        return Topic::select(['id', 'name'])
            ->where('name', 'like', '%' . $request->query('q') . '%')
            ->get();
    }
}