<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Post;
use App\Topic;
use App\Transformers\TopicTransformer;
use function fractal;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);

        return fractal()
            ->item($topic)
            ->parseIncludes(['user', 'posts.user'])
            ->transformWith(new TopicTransformer)
            ->toArray();

    }
}
