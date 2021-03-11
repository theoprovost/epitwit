<?php

namespace App\Models;

use App\Tweets\Entities\EntityDatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function newCollection(array $models = [])
    {
        return new EntityDatabaseCollection($models);
    }

    public function tweets()
    {
        return $this->belongsToMany(Tweet::class, 'entities', 'id', 'tweet_id');
    }
}
