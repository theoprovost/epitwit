<?php

namespace App\Notifications\Tweets;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Bus\Queueable;
use App\Http\Resources\UserResource;
use App\Http\Resources\TweetResource;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\DatabaseNotificationChannel;
use Illuminate\Notifications\Messages\MailMessage;

class TweetRepliedTo extends Notification
{
    use Queueable;

    protected $user, $tweet;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            DatabaseNotificationChannel::class // used to get type shortname
        ]; // 'database' <=> DatabaseChannel::class
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => new UserResource($this->user),
            'tweet' => new TweetResource($this->tweet)
        ];
    }
}
