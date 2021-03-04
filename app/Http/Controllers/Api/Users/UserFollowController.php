<?php

namespace App\Http\Controllers\Api\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SebastianBergmann\Environment\Console;

class UserFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function store(Request $request, $user_id)
    {
        $follow = $request->user()->follow()->create([
            'following_id' => $user_id
        ]);
        // A voir si ça suffit ou si il faut rajouter des infos dans le create
    }

    public function destroy(Request $request, $user_id)
    {
        $request->user()->follow()->where('following_id', $user_id)->first()->delete();
    }
}
