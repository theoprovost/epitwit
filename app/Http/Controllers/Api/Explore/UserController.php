<?php

namespace App\Http\Controllers\Api\Explore;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TweetCollection;
use SebastianBergmann\Environment\Console;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

     public function find(Request $request)
    {
        $users = User::where('username', 'like', $request->data . '%')
        ->orWhere('name','like', '%' . $request->data . '%')
        ->where('id', '!=', Auth::id())
        ->get();

        return collect($users);
    }

}