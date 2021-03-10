<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request, $authId, $userId)
    {
        return view('conversation', compact('authId', 'userId'));
    }
}
