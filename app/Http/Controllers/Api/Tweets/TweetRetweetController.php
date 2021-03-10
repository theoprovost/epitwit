<?php

namespace App\Http\Controllers\Api\Tweets;


use App\Models\Tweet;
use App\Tweets\TweetType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetRetweetsWereUpdated;
use App\Events\Tweets\TweetWasDeleted;

class TweetRetweetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function store(Tweet $tweet, Request $request)
    {
        $retweet = $request->user()->tweets()->create([
            'type'=> TweetType::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($retweet));
        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        broadcast(new TweetWasDeleted($tweet->retweetedTweet)); //Important : needs to be fired before actually being deleted in DB, otherwise, the resource won't be accessible.

        $tweet->retweetedTweet()->where('user_id', $request->user()->id)->where('type', TweetType::RETWEET)->delete(); // where clause prevents from deleting other people posts + relation retweetedTweet leads to the retweet and not the original tweet.

        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));
    }
}
