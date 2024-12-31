<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'description'=> $this->description,
            'upvotes'=> $this->upvotes->count(),
            'comments'=> $this->comments->count(),
            'created_at'=> $this->created_at->diffForHumans(),
            'user'=> new UserResource($this->user),
            'upvote_count'=>$this->upvote_count ?: 0,
            'user_has_upvoted'=>(bool) $this->user_has_upvoted,
            'user_has_downvoted'=> (bool)$this->user_has_downvoted,
        ];
    }
}
