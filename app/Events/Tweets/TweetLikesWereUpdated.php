<?php

namespace App\Events\Tweets;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use App\Http\Resources\TweetResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TweetLikesWereUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $tweet, $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
    }

    public function broadcastAs()
    {
        return 'TweetLikesWereUpdated'; // override class name so the frond-end doesn't see the structure
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->tweet->id,
            'user_id' => $this->user->id,
            'count' => $this->tweet->likes->count(),
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tweets');
    }


}
