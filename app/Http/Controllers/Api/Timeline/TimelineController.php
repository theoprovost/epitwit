<?php

namespace App\Http\Controllers\API\Timeline;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;

class TimelineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        $tweets = $request->user()
                        ->tweetsFromFollowing()
                        ->parent() // Scope : display only 'parent type' tweets
                        ->with([
                            'user',
                            'likes',
                            'retweets',
                            'replies',
                            'entities',
                            'media.baseMedia', // both media and baseMedia
                            'originalTweet.user',
                            'originalTweet.likes',
                            'originalTweet.retweets',
                            'originalTweet.media.baseMedia'
                        ])
                        ->latest()
                        ->paginate(8);
        return new TweetCollection($tweets);
    }

    public function user_index(Request $request, $user)
    {
        $user = User::with([
            'following',
            'followers',
            'tweets',
            'retweets',
            'likes'
            ])->where('username', '=', $user)
            ->get();
            $user = $user[0];
            return new TweetCollection($user['tweets']);
    }
}
