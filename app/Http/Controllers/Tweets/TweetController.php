<?php

namespace App\Http\Controllers\Tweets;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;

class TweetController extends Controller
{
    public function show(Tweet $tweet)
    {
            return view('tweets.show', compact('tweet'));
    }
}
