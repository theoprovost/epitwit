<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\MessageResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageWasCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $message, $user1, $user2;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message, $user1, $user2)
    {
        $this->message = $message;
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    public function broadcastAs()
    {
        return 'MessageWasCreated'; // override class name so the frond-end doesn't see the structure
    }

    public function broadcastWith()
    {
        return (new MessageResource($this->message))->jsonSerialize();
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('messages.' . $this->user1 . "." . $this->user2);
    }
}
