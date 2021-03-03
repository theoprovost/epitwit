<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function store(User $user, Request $request)
    {
        $follow = $request->user()->following()->create();
        // A voir si ça suffit ou si il faut rajouter des infos dans le create
    }

    public function destroy(User $user, Request $request)
    {

    }
}
