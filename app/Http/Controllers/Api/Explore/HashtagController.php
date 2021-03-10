<?php

namespace App\Http\Controllers\Api\Explore;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class HashtagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function find(Request $request)
    {
        return Entity::with([
            'tweets'
        ])->where('body_plain', 'like', '%' . $request->data . '%')->get();
    }
}
