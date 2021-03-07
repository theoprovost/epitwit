<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Entity;
use App\Tweets\TweetType;
use App\Models\TweetMedia;
use App\Tweets\Entities\EntityExtractor;
use App\Tweets\Entities\EntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tweet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function(Tweet $tweet) {
            $tweet->entities()->createMany(
                (new EntityExtractor($tweet->body))->getAllEntities()
            );
        });
    }

    public function scopeParent(Builder $builder) // Laravel scope : always prefixed with scope[Thenthenameofthescope]
    {
        return $builder->whereNull('parent_id'); // in db, parents doesn't have parents
    }

    public function parents()
    {
        $base = $this;
        $parents = [];

        while($base->parentTweet) {
            $parents[] = $base->parentTweet;
            $base = $base->parentTweet;
        }

        return collect($parents);
    }

    public function parentTweet()
    {
        return $this->belongsTo(Tweet::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function originalTweet()
    {
        return $this->hasOne(Tweet::class, 'id', 'original_tweet_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function retweets()
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id')->where('type', TweetType::RETWEET);
    }

    public function retweetedTweet()
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id')->where('type', TweetType::RETWEET);;
    }

    public function media()
    {
        return $this->hasMany(TweetMedia::class);
    }

    public function replies()
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    public function mentions()
    {
        return $this->hasMany(Entity::class)
                    ->whereType(EntityType::MENTION);
    }
}
