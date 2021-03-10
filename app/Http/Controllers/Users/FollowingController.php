<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowingController extends Controller
{
    public function index(Request $request, $username)
    {
        $user = User::with([
                    'following',
                ])->where('username', '=', $username)
                ->get()->first();
                $user->followers = $user->following->map(function($follower) {
                    return [
                    'id' => $follower->id,
                    'name' => $follower->name,
                    'username' => $follower->username,
                    'biography' => $follower->biography,
                    'avatar' => $follower->avatar(),
                    'followers' => $follower->followers()->get(),
                    ];
                })->where("id", "!=", $user->id);
        $authUser = $request->user();
        $authId = $authUser->id;
        return view('followers', compact('user', 'authId'));
    }
}
