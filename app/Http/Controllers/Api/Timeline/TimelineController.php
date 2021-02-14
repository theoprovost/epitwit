<?php

namespace App\Http\Controllers\API\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use Illuminate\Http\Request;

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
                        ->with([
                            'user',
                            'likes'
                        ])
                        ->latest()
                        ->paginate(8);

        return new TweetCollection($tweets);
    }
}
