<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Request;

class TopicsController extends Controller
{
    protected $topic;

    /**
     * TopicsController constructor.
     * @param $topic
     */
    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    public function index(Request $request)
    {
        return $this->topic->getTopicForTagging($request);
    }
}
