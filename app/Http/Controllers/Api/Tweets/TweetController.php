<?php

namespace App\Http\Controllers\API\Tweets;

use App\Models\Tweet;
use App\Tweets\TweetType;
use App\Models\TweetMedia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetWasDeleted;
use App\Http\Resources\TweetCollection;
use App\Http\Resources\TweetMediaResource;
use App\Events\Tweets\TweetRetweetsWereUpdated;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Notifications\Tweets\TweetMentionnedIn;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        $tweets = Tweet::with([
                            'user',
                            'likes',
                            'retweets',
                            'replies',
                            'entities',
                            'media.baseMedia', // both media and baseMedia
                            'originalTweet.user',
                            'originalTweet.likes',
                            'originalTweet.retweets',
                            'originalTweet.replies',
                            'originalTweet.media.baseMedia',
                        ])->find(explode(',', $request->ids));

        return new TweetCollection($tweets);
    }

    public function show(Tweet $tweet)
    {
        return new TweetCollection(collect([$tweet])->merge($tweet->parents()));
    }

    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), [
            'type' => TweetType::TWEET,
        ]));

        foreach ($request->media as $id) {
            $tweet->media()->save(TweetMedia::find($id));
        };

        foreach ($tweet->mentions->users() as $user) {
            if ($request->user()->id !== $user->id) {
                $user->notify(new TweetMentionnedIn($request->user(), $tweet));
            };
        };

        broadcast(new TweetWasCreated($tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        broadcast(new TweetWasDeleted($tweet)); //Important : needs to be fired before actually being deleted in DB, otherwise, the resource won't be accessible.
        $retweets = $tweet->retweets()->get();
        foreach($retweets as $retweet)
        {
            broadcast(new TweetWasDeleted($retweet)); //Important : needs to be fired before actually being deleted in DB, otherwise, the resource won't be accessible.
        }
        $quoted = $tweet->quoted()->get();
        foreach($quoted as $quote)
        {
            broadcast(new TweetWasDeleted($quote)); //Important : needs to be fired before actually being deleted in DB, otherwise, the resource won't be accessible.
        }
        $tweet->retweets()->delete();
        $tweet->delete();

    }
}
