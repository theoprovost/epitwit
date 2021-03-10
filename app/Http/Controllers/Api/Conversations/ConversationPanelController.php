<?php

namespace App\Http\Controllers\Api\Conversations;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationCollection;

class ConversationPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        $users = $request->user()->senders->merge($request->user()->receivers);
        $collection =  new ConversationCollection($users);
        return $collection->values();
    }
}
