<?php

namespace App\Http\Controllers\Api\Explore;

use App\Models\User;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TweetCollection;
use SebastianBergmann\Environment\Console;

class HashtagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function find(Request $request)
    {
        $query = Entity::with([
            'tweets'
        ])
        ->where('body_plain', 'like', $request->data . '%')
        ->where('type', '=', 'hashtag')
        ->get();

        $tweets = $query->pluck('tweets')->collapse(); // remove nested array

        return new TweetCollection($tweets);
    }

}
