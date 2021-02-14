<?php

namespace App\Http\Resources;

use App\Http\Resources\TweetResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TweetCollection extends ResourceCollection
{

    public $collects = TweetResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'likes' => $this->likes($request),
                'retweets' => $this->retweets($request),
            ]
        ];
    }

    protected function likes($request)
    {
        if (!$user = $request->user()) {
            return [];
        };

        return $user->likes()
            ->whereIn(
                'tweet_id',
                $this->collection->pluck('id')->merge($this->collection->pluck('original_tweet_id'))// pluck : get/extract
            )
            ->pluck('tweet_id')
            ->toArray();
    }

    protected function retweets($request)
    {
        if (!$user = $request->user()) {
            return [];
        };

        return $user->retweets()
            ->whereIn(
                'original_tweet_id',
                $this->collection->pluck('id')->merge($this->collection->pluck('original_tweet_id')) // Make sure all the original ids of tweet are directly loaded and not after scrolling down the page
            )
            ->pluck('original_tweet_id')
            ->toArray();

    }
}