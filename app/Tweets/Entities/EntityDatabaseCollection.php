<?php

namespace App\Tweets\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EntityDatabaseCollection extends Collection // needs to be collection type
{
    public function users()
    {
        return User::whereIn('username', $this->pluck('body_plain'))->get(); // pluck : return a new collection from designated column
    }
}