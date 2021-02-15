<?php

namespace App\Http\Controllers\API\Tweets;

use App\Tweets\TweetType;
use App\Models\TweetMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Resources\TweetMediaResource;
use App\Http\Requests\Tweets\TweetStoreRequest;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['store']);
    }

    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), [
            'type' => TweetType::class::TWEET,
        ]));

        foreach ($request->media as $id) {
            $tweet->media()->save(TweetMedia::find($id));
        };

        broadcast(new TweetWasCreated($tweet));
    }
}
