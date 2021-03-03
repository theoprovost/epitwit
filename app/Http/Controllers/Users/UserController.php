<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(Request $request, $username)
    {
        $user = User::with([
                    'following',
                    'followers',
                    'tweets',
                    'retweets',
                    'likes'
                ])->where('username', '=', $username)
                ->get();

        $user = $user[0];
        return $user;

        return view('profile', compact('user'));
    }
}
