<?php

namespace App\Models;

use App\Http\Resources\UserResource;
use App\Models\Like;
use App\Models\Tweet;
use App\Tweets\TweetType;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'dob',
        'email',
        'password',
        'country',
        'city',
        'website',
        'biography',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mp';
    }

    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'user_id',
            'following_id'
        );
    }

    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'following_id',
            'user_id'
        );
    }

    public function hasRetweet(Tweet $tweet)
    {
        return $this->retweets->contains('id', $tweet->id);
    }

    public function hasLiked(Tweet $tweet)
    {
        return $this->likes->contains('tweet_id', $tweet->id);
    }

    /** TO COMMENT
     *
     */

    public function tweetsFromFollowing()
    {
        return $this->hasManyThrough(
            Tweet::class, // final model
            Follower::class, // intermediate model
            'user_id', // foreign key on the intermediate model
            'user_id', // foreign key on the final model
            'id', // local key
            'following_id' // local key of the intermediate model
        );
    }
    /**
    *
    */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function follow()
    {
        return $this->hasMany(Follower::class);
    }

    public function retweets()
    {
        return $this->hasMany(Tweet::class)
            ->where('type', TweetType::RETWEET);
    }

    public function sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function received()
    {
        return $this->hasMany(Message::class, 'sent_to_id');
    }

    public function lastsentTo($userId)
    {
        return $this->hasMany(Message::class, 'sender_id')->where('sent_to_id', $userId)->latest()->first();
    }

    public function lastsentBy($userId)
    {
        return $this->hasMany(Message::class, 'sent_to_id')->where('sender_id', $userId)->latest()->first();
    }

    public function senders()
    {
        return $this->hasManyThrough(
            User::class,
            Message::class,
            'sent_to_id',
            'id',
            'id',
            'sender_id'
        )->distinct();
    }

    public function receivers()
    {
        return $this->hasManyThrough(
            User::class,
            Message::class,
            'sender_id',
            'id',
            'id',
            'sent_to_id'
        )->distinct();
    }

    public function latestWith($userId)
    {
        $lastSentTo = $this->lastsentTo($userId);
        $lastSentBy = $this->lastsentBy($userId);
        if (!$lastSentTo)
            return $lastSentBy;
            if (!$lastSentBy)
            return $lastSentTo;
        return ($lastSentTo->created_at > $lastSentBy->created_at) ? $lastSentTo : $lastSentBy;
    }
}
