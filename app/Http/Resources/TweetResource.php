<?php

namespace App\Http\Resources;

use App\Http\Resources\MediaCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body === '' ? null : $this->body,
            'type' => $this->type,
            'original_tweet' => new TweetResource($this->originalTweet),
            'user' => new UserResource($this->user),
            'likes_count' => $this->likes->count(),
            'retweets_count' => $this->retweets->count(),
            'replies_count' => $this->replies->count(),
            'media' => new MediaCollection($this->media),
            'entities' => new EntityCollection($this->entities),
            'created_at' => $this->created_at->timestamp
        ];
    }
}
