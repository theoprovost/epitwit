<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'avatar' => $this->avatar(),
            'last' => $request->user()->latestWith($this->id),
            'created_at' => $request->user()->latestWith($this->id)->created_at->timestamp,
            'creation_date' => date_format($request->user()->latestWith($this->id)->created_at, "g:i a | M j, Y"),
        ];
    }
}
