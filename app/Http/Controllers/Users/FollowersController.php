<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowersController extends Controller
{
    public function index(Request $request, $username)
    {
        $user = User::with([
                    'followers',
                ])->where('username', '=', $username)
                ->get()->first();
                $user->followers = $user->followers->map(function($follower) {
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
