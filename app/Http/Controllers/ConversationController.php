<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request, $authId, $userId)
    {
        if ($request->user()->id != $authId)
            return redirect('messages');
        return view('conversation', compact('authId', 'userId'));
    }
}
