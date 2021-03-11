<?php

namespace App\Http\Controllers\Api\Conversations;

use App\Events\MessageWasCreated;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageCollection;
use App\Http\Requests\MessageStoreRequest;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request, $authId, $userId)
    {
        $messages = $request->user()->received()->where('sender_id', $userId)->latest()->get()->merge($request->user()->sent()->where('sent_to_id', $userId)->latest()->get());
        $collection = new MessageCollection($messages);
        return $collection;
    }

    public function store(MessageStoreRequest $request, $userId)
    {
        $message = $request->user()->sent()->create(["body"=> $request->get('body'), 'sent_to_id' => $userId, 'sender_id' => $request->user()->id]);
        broadcast(new MessageWasCreated($message, $userId, $request->user()->id));
        broadcast(new MessageWasCreated($message, $request->user()->id, $userId));

    }
}
