<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Models\Tweet;
use App\Tweets\TweetType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TweetQuoteController extends Controller
{
    public function store(Tweet $tweet, Request $request)
    {
        $retweet = $request->user()->tweets()->create([
            'type'=> TweetType::QUOTE,
            'body' => $request->body,
            'original_tweet_id' => $tweet->id
        ]);

        // broadcast(new TweetWasCreated($retweet));
        // broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));
    }
}
