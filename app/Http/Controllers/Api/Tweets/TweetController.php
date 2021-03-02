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
use App\Http\Resources\TweetCollection;
use App\Http\Resources\TweetMediaResource;
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
                            'media.baseMedia', // both media and baseMedia
                            'originalTweet.user',
                            'originalTweet.likes',
                            'originalTweet.retweets',
                            'originalTweet.media.baseMedia'
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
            'type' => TweetType::class::TWEET,
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
}
