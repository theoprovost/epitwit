<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

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
                ->get()->first();
        $authUser = $request->user();
        $authId = $authUser->id;

        return view('profile', compact('user', 'authId'));
    }
    public function get(request $request, $userId)
    {
        return new UserResource(User::where('id', $userId)->get()->first());

    }
}
