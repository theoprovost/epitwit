<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversationPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        return view('messages');
    }
}
